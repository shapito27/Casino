<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:58
 */

namespace App\Services;


class SubjectAccountType extends AccountType
{
    public function getSystemAccountId():int
    {
        return (int)env('SYSTEM_SUBJECT_ACCOUNT');
    }
}