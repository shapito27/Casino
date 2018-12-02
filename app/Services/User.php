<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:12
 */

namespace App\Services;


use App\Exceptions\AccountNotFoundException;
use App\Exceptions\IsPrizeNotConvertableException;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class User
{
    /** @var Auth */
    private $auth;

    /** @var Account */
    private $account;

    /** @var int */
    private $id;

    public const SUCCESS_WITHDRAW = 'Заявка на вывод средств оформлена. После подтверждения средства будут отправлены на ваш счет.';
    public const FAIL_WITHDRAW = 'Ошибка перевода!';

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Auth $auth
     */
    public function setAuth(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * set account Service
     * @param mixed $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    public function getAccount(): Account
    {
        if ($this->account === null) {
            $this->setAccount(app('App\Models\Account'));
        }

        return $this->account;
    }

    /**
     * @return Auth
     */
    public function getAuth(): Auth
    {
        if ($this->auth === null) {
            $this->setAuth(app('Auth'));
        }

        return $this->auth;
    }

    /**
     * @return int
     * @throws AuthorizationException
     */
    public function getCurrentUserId(): int
    {
        $auth = $this->getAuth();
        $user = $auth::user();

        if ($user === null) {
            throw new AuthorizationException('Something wrong! No authorization user!');
        }

        return $user->id;
    }

    /**
     * preparing trnsfer class and prizeTransmiter for Prize because we need trnsfer it
     * @param Prize $prize
     * @param Account $senderAccount
     * @param Account $receiverAccount
     * @param string $type
     * @param $status
     * @return Prize
     */
    public function prepareForTransferingPrize(
        Prize $prize,
        Account $senderAccount,
        Account $receiverAccount,
        string $type,
        $status
    ): Prize {
        /** @var Transfer $transfer */
        $transfer = app('transfer');
        $transfer->setSenderAccount($senderAccount);
        $transfer->setReceiverAccount($receiverAccount);

        $transfer->setType($type);
        $transfer->setStatus($status);
        $transfer->setValue($prize->getValue());

        /** @var PrizeTransmiter $prizeTransmiter */
        $prizeTransmiter = app('prize.transmiter');
        $prizeTransmiter->setTransfer($transfer);

        $prize->setTransmiter($prizeTransmiter);

        return $prize;
    }

    /**
     * Win prize
     * @param PrizeGenerator $prizeGenerator
     * @return Prize
     * @throws AccountNotFoundException
     */
    public function winPrize(PrizeGenerator $prizeGenerator): Prize
    {
        /** @var Prize $prize */
        $prize = $prizeGenerator->generate();

        $userAccount = $this->getAccountByPrizeAndUserId($prize, $this->getId());
        $systemAccount = $this->getAccountByPrizeAndUserId($prize, $this->getSystemUserId());
        /** @var Transfer $transfer */
        $transfer = app('transfer');
        $type = $transfer::OPERATION_TYPE_WIN;
        $status = $userAccount->getWinStatus();

        $prize = $this->prepareForTransferingPrize($prize, $systemAccount, $userAccount, $type, $status);
        //transfer prize to user account
        $prize->transfer();

        return $prize;
    }

    /**
     * Refuse won prize
     * @param Prize $prize
     * @throws AccountNotFoundException
     */
    public function refusePrize(Prize $prize)
    {
        $userAccount = $this->getAccountByPrizeAndUserId($prize, $this->getId());
        $systemAccount = $this->getAccountByPrizeAndUserId($prize, $this->getSystemUserId());
        /** @var Transfer $transfer */
        $transfer = app('transfer');
        $type = $transfer::OPERATION_TYPE_REFUSE;
        $status = $userAccount->getWinStatus();

        $prize = $this->prepareForTransferingPrize($prize, $userAccount, $systemAccount, $type, $status);

        //transfer prize to user account
        $prize->transfer();
    }

    /**
     * Convert prize to another type of prize. If it convertable
     * @param MoneyPrize $prize
     * @return BonusPrize
     * @throws IsPrizeNotConvertableException
     * @throws \ReflectionException
     */
    public function convertPrize(MoneyPrize $prize): BonusPrize
    {
        if ($prize->isConvertable() === false) {
            throw new IsPrizeNotConvertableException('You are tring to convert unconvertable prize!');
        }

        $prize = $this->prepareForConvertingPrize($prize);

        return $prize->convert();
    }

    public function prepareForConvertingPrize(MoneyPrize $prize): MoneyPrize
    {
        $currentUser = $this->getId();
        $senderAccount = $this->getAccountByPrizeAndUserId($prize, $currentUser);

        /** @var ConvertationTransfer $convertationTransfer */
        $convertationTransfer = app('convertation.transfer');
        /** @var PrizeConverter $prizeConverter */
        $prizeConverter = app('prize.converter');

        $prizeConverter->setConvertationTransfer($convertationTransfer);

        $receiverAccount = $this->getAccountByPrizeAndUserId($prizeConverter->getConvertTo(), $currentUser);

        $convertationTransfer->setSenderAccount($senderAccount);
        $convertationTransfer->setReceiverAccount($receiverAccount);

        $convertationTransfer->setType($convertationTransfer::OPERATION_TYPE_CONVERTATION);
        $convertationTransfer->setStatus($convertationTransfer::OPERATION_STATUS_OK);// wait только для money аккаунта
        $convertationTransfer->setValue($prize->getValue());

        $prize->setConverter($prizeConverter);

        return $prize;
    }

    /**
     * withdraw from user Money Account
     * @return bool
     * @throws AuthorizationException
     * @throws \App\Exceptions\AccountBalanceHistoryNotFoundException
     * @throws \App\Exceptions\NotSetedAccountIdException
     */
    public function withdraw(): bool
    {
        /** @var MoneyAccount $userMoneyAccount */
        $userMoneyAccount = app('money.account');
        /** @var MoneyAccount $systemMoneyAccount */
        $systemMoneyAccount = app('money.account');

        $userMoneyAccount->setAccountId($userMoneyAccount->findAccountByUserId($this->getCurrentUserId())->id);
        $systemMoneyAccount->setAccountId($systemMoneyAccount->findAccountByUserId($this->getSystemUserId())->id);

        /** @var Transfer $transfer */
        $transfer = app('transfer');
        $transfer->setSenderAccount($userMoneyAccount);
        $transfer->setReceiverAccount($systemMoneyAccount);

        $transfer->setType($transfer::OPERATION_TYPE_WITHDRAW);
        $transfer->setStatus($transfer::OPERATION_STATUS_WAIT);

        $transfer->setValue($userMoneyAccount->getBalanceValue($userMoneyAccount->getAccountId()));
        $transfer->run();

        return true;
    }

    /**
     * @return int
     * @throws AccountNotFoundException
     */
    public function getSystemUserId(): int
    {
        try {
            return \App\Models\User::withRole('Admin')->firstOrFail()->id;
        } catch (ModelNotFoundException $exception) {
            Log::critical('Admin Account not found!');
            throw new AccountNotFoundException();
        }
    }

    /**
     * @param Prize $prize
     * @param int $userId
     * @return Account
     */
    public function getAccountByPrizeAndUserId(Prize $prize, int $userId): Account
    {
        /** @var AccountHelper $accountHelper */
        $accountHelper = new AccountHelper();

        /** @var Account $account */
        $account = app($accountHelper->getAccountTypeByPrize($prize));
        $account->setAccountId($account->findAccountByUserId($userId)->id);

        return $account;
    }

    /**
     * @return array
     * @throws AuthorizationException
     * @throws \App\Exceptions\AccountBalanceHistoryNotFoundException
     */
    public function getCurrentBalance()
    {
        // get user
        $curUsser = $this->getCurrentUserId();

        /** @var MoneyAccount $moneyAccount */
        $moneyAccount = app('money.account');
        $moneyAccountId = $moneyAccount->findAccountByUserId($curUsser)->id;
        $moneyAccountBalanceValue = $moneyAccount->getBalanceValue($moneyAccountId);

        /** @var BonusAccount $bonusAccount */
        $bonusAccount = app('bonus.account');
        $bonusAccountId = $bonusAccount->findAccountByUserId($curUsser)->id;
        $bonusAccountBalanceValue = $bonusAccount->getBalanceValue($bonusAccountId);

        /** @var SubjectAccount $subjectAccount */
        $subjectAccount = app('subject.account');
        $subjectAccountId = $subjectAccount->findAccountByUserId($curUsser)->id;
        $subjectAccountBalanceValue = $subjectAccount->getBalanceValue($subjectAccountId);

        return [
            Prize::MONEY => $moneyAccountBalanceValue,
            Prize::BONUS => $bonusAccountBalanceValue,
            Prize::SUBJECT => $subjectAccountBalanceValue,
        ];
    }

    /**
     * @param array $userBalance
     * @return string
     */
    public function getUserBalanceForView(array $userBalance): string
    {
        return 'На счету: ' . $userBalance[Prize::BONUS] . ' бонусов' . ' | ' . $userBalance[Prize::MONEY] . ' ₽';
    }

    public function getOerationsHistoryByUserId($userId)
    {
        //@todo
    }
}