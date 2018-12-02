<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:58
 */

namespace App\Services;


use app\Exceptions\NotDefinedOperationTypeException;
use app\Exceptions\SubjectNotExistsException;

class SubjectAccount extends Account
{
    private $accountTypeBalanceDefaultValue = [];

    public static function notEnoughBalance()
    {
        throw new SubjectNotExistsException();
    }

    public function checkAccountBalanceHasEnough(int $value)
    {
        $accountId = $this->getAccountId();

        /** @var array $subjects */
        $subjects = $this->getBalanceValue($accountId);

        if(in_array($value, $subjects) !== true){
            throw new SubjectNotExistsException();
        }

        return true;
    }

    /**
     * @param int $accountId
     * @param int $value
     * @param int $type
     * @return string
     * @throws NotDefinedOperationTypeException
     * @throws SubjectNotExistsException
     */
    public function prepareBalanceValue(int $accountId, int $value, int $type):string
    {
        /** @var array $currentBalance */
        $currentBalance = $this->getBalanceValue($accountId);
        switch ($type) {
            case Operation::DEBET:
                array_push($currentBalance, $value);
                break;
            case Operation::CREDIT:

                $key = null;
                if(($key = array_search($value, $currentBalance)) === false){
                    throw new SubjectNotExistsException('Admin Attention! Can`t credit subject from account');
                }

                unset($currentBalance[$key]);
                //reindex array
                $currentBalance = array_values($currentBalance);
                //если это админ и у него с акаунта выводим предмет, то предмет становится not available,
                // чтобы другие игроки не могли его выйграть
                //@todo добавить блокировку предмета в функции, где выйгрышь генерируется
                if ($this->getSystemAccountId() === $accountId) {
                    Subject::markAsNotAvailable($value);
                }
                break;
            default:
                throw new NotDefinedOperationTypeException();
        }

        return $this->prepareSubjectsForSaving($currentBalance);
    }

    /**
     * @return string
     */
    public function prepareInitBalanceValue():string
    {
        return $this->prepareSubjectsForSaving($this->accountTypeBalanceDefaultValue);
    }

    /**
     * @param int $accountId
     * @return array
     */
    public function getBalanceValue(int $accountId):array
    {
        return json_decode($this->getBalance($accountId)->value, true);
    }

    /**
     * @param array $subjects
     * @return string
     */
    public function prepareSubjectsForSaving(array $subjects):string
    {
        return json_encode($subjects);
    }


}