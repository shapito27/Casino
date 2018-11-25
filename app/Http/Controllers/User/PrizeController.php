<?php

namespace App\Http\Controllers\User;

use App\Services\User;
use App\Http\Controllers\Controller;

class PrizeController extends Controller
{
    /**
     * Action after pressing button Play
     * @throws \Exception
     */
    public function getPrize()
    {
        $prize = \App\Services\Prize::generateRandomPrize();
        $user = new User();
        $user->getPrize($prize);
    }

    public function play()
    {
        return view('user.prize');
    }
}
