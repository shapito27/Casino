<?php

namespace Tests\Feature;

use App\Services\BonusPrize;
use App\Services\ConvertationTransfer;
use Tests\TestCase;
use Mockery;

class ConvertationMoneyPrizeTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     *
     *
     * @return void
     */
    public function testPrizeConvertation()
    {
        /** @var int $userId user id for test*/
        $userId = 2;
        $accountId = null;

        /** @var \App\Services\MoneyPrize $prize */
        $prize = app('money.prize');

        // init value
        $beforeconvertedValue = $prize->getValue();
        //value for check convertation
        $afterConvertedValue = $beforeconvertedValue * app('exchange.rate')->getRate();//$beforeconvertedValue*10 = 5400

        /** @var \App\Services\User $user */
        $user = app('user');
        $user->setId($userId);

        $senderAccount = $user->getAccountByPrizeAndUserId($prize, $userId);

        /** @var ConvertationTransfer $convertationTransfer Mock result of ConvertationTransfer::run where we write operations to DB*/
        $mockedConvertationTransfer = Mockery::mock(ConvertationTransfer::class);
        $mockedConvertationTransfer->makePartial();
        $mockedConvertationTransfer->shouldReceive('run')->once()->andReturn(true);

        /** @var PrizeConverter $prizeConverter */
        $prizeConverter = app('prize.converter');

        $prizeConverter->setConvertationTransfer($mockedConvertationTransfer);
        $mockedConvertationTransfer->setModel(app('App\Models\Operation'));

        $receiverAccount = $user->getAccountByPrizeAndUserId($prizeConverter->getConvertTo(), $userId);

        $mockedConvertationTransfer->setSenderAccount($senderAccount);
        $mockedConvertationTransfer->setReceiverAccount($receiverAccount);
        $mockedConvertationTransfer->setType($mockedConvertationTransfer::OPERATION_TYPE_CONVERTATION);

        $mockedConvertationTransfer->setStatus($mockedConvertationTransfer::OPERATION_STATUS_OK);// wait только для money аккаунта
        $mockedConvertationTransfer->setValue($prize->getValue());

        $prize->setConverter($prizeConverter);

        /** @var BonusPrize $convertedPrize */
        $convertedPrize = $prize->convert();

        $this->assertEquals($convertedPrize->getValue(), $afterConvertedValue);
    }
}
