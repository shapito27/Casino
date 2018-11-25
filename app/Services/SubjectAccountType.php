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

class SubjectAccountType extends AccountType
{
    private static $accountTypeBalanceDefaultValue = [];

    public static function notEnoughBalance()
    {
        throw new SubjectNotExistsException();
    }

    public static function checkAccountBalanceHasEnough(int $accountId, int $value)
    {
        /** @var array $subjects */
        $subjects = self::getBalanceValue($accountId);

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
    public static function prepareBalanceValue(int $accountId, int $value, int $type):string
    {
        /** @var array $currentBalance */
        $currentBalance = self::getBalanceValue($accountId);
        switch ($type) {
            case Operation::DEBET:
                array_push($currentBalance, $value);
                break;
            case Operation::CREDIT:

                $key = null;
                if(($key = array_search($value, $currentBalance)) === false){
                    throw new SubjectNotExistsException('Admin Attention! CAn`t credit subject from account');
                }

                unset($currentBalance[$key]);
                //reindex array
                $currentBalance = array_values($currentBalance);
                //если это админ и у него с акаунта выводим предмет, то предмет становится not available,
                // чтобы другие игроки не могли его выйграть
                //@todo добавить блокировку предмета в функции, где выйгрышь генерируется
                if ((new self)->getSystemAccountId() === $accountId) {
                    Subject::markAsNotAvailable($value);
                }
                break;
            default:
                throw new NotDefinedOperationTypeException();
        }

        return self::prepareSubjectsForSaving($currentBalance);
    }

    /**
     * @return string
     */
    public static function prepareInitBalanceValue():string
    {
        return self::prepareSubjectsForSaving(self::$accountTypeBalanceDefaultValue);
    }

    /**
     * @param int $accountId
     * @return array
     */
    public static function getBalanceValue(int $accountId):array
    {
        return json_decode(Account::getBalance($accountId)->value, true);
    }

    /**
     * @param array $subjects
     * @return string
     */
    public static function prepareSubjectsForSaving(array $subjects):string
    {
        return json_encode($subjects);
    }


}