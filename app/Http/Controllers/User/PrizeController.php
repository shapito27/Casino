<?php

namespace App\Http\Controllers\User;

use App\Services\Prize;
use App\Services\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    /**
     * Action after pressing button Play
     * @throws \Exception
     */
    public function getPrize(Request $request)
    {
        /** @var Prize $prize */
        $prize = \App\Services\Prize::generateRandomPrize();
        $user = new User();
        //transfer prize to user account
        $user->getPrize($prize);

        $prizeName = $prize->getNameForView();

        $request->session()->put('key', 'value');

        return response()->json(
            [
                'view' => view('user.prize', [
                    'prizeName' => $prizeName,
                    'prizeId' => $prize->value,
                    'showConvertationButton' => $prize->getType() === Prize::MONEY ? true : false
                ])->render()
            ],
            200
        );
    }

    public function refusePrize(Request $request)
    {
        /** @var Prize $prize last prize from session */
        $prize = $request->session()->get(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);

        /** @var User $user */
        $user = new User();
        //transfer prize to user account
        $user->refusePrize($prize);

        //delete from session last gotten prize
        $request->session()->remove(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);

        return response()->json(
            [
                'view' => view('user.prize-refuse')->render()
            ],
            200
        );
    }


    public function convertMoneyPrize(Request $request)
    {
        /** @var Prize $prize last prize from session */
        $prize = $request->session()->get(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);

        $user = new User();
        //transfer prize to user account
        $user->convertPrize($prize);
//        $request->session()->remove(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);
//
//        return response()->json(
//            [
//                'view' => view('user.prize-refuse')->render()
//            ],
//            200
//        );
    }

    public function game()
    {
        return view('user.game');
    }
}
