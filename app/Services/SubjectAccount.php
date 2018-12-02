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
     * @throws \App\Exceptions\SystemAccountNotFoundException
     */
    public function prepareBalanceValue(int $accountId, int $value, int $type):string
    {
        /** @var array $currentBalance */
        $currentBalance = $this->getBalanceValue($accountId);
        switch ($type) {
            case Transfer::DEBET:
                //push new subject to array of subjects
                array_push($currentBalance, $value);
                break;
            case Transfer::CREDIT:

                $key = null;
                //try to find subject in array of subjects. It have to be there
                if(($key = array_search($value, $currentBalance)) === false){
                    throw new SubjectNotExistsException('Admin Attention! Can`t credit subject from account');
                }

                //when we found it we need delete subject from array
                unset($currentBalance[$key]);
                //reindex array
                $currentBalance = array_values($currentBalance);
                //if it's admin and transfer subject from his account then subject not available anymore for other gamers
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
     * @throws \App\Exceptions\AccountBalanceHistoryNotFoundException
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