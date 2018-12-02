<?php

namespace App\Http\Controllers\User;

use App\Services\User;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function accaunt()
    {
        $userBalance = $this->user->getCurrentBalance();

        return view('user.account',[
            'userBalance' => $userBalance
        ]);
    }

    public function withdraw()
    {
        $result = $this->user->withdraw();

        return response()->json(
            [
                $result?$this->user::SUCCESS_WITHDRAW:$this->user::FAIL_WITHDRAW,
            ],
            200
        );
    }

    public function curentBalance()
    {
        $userBalance = $this->user->getCurrentBalance();

        return response()->json(
            [
                $this->user->getUserBalanceForView($userBalance)
            ],
            200
        );
    }
}
