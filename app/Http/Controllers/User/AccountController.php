<?php

namespace App\Http\Controllers\User;

use App\Services\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function operationHistory()
    {
        // get user
        $userId = $this->user->getCurrentUser();
        $this->user->getOerationsHistoryByUserId($userId);

        return view('account.history');
    }

    public function curentBalance()
    {
        $userBalance = $this->user->getCurrentBalance();

        return response()->json(
            [
                'view' => view('account.balance', [
                    'userBalance' => $userBalance
                ])->render()
            ],
            200
        );
    }
}
