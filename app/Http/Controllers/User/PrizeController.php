<?php

namespace App\Http\Controllers\User;

use App\Services\Prize;
use App\Services\Subject;
use App\Services\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PrizeController extends Controller
{
    /**
     * Action after pressing button Play
     * @throws \Exception
     */
    public function getPrize()
    {
        /** @var Prize $prize */
        $prize = \App\Services\Prize::generateRandomPrize();
        $user = new User();
        //transfer prize to user account
        $user->getPrize($prize);

        $prizeName = $prize->getNameForView();

        return response()->json(
            [
                'view' => view('user.prize', [
                    'prizeName' => $prizeName,
                    'prizeId' => $prize->value,
                ])->render()
            ],
            200
        );
    }

    public function game()
    {
        return view('user.game');
    }
}
