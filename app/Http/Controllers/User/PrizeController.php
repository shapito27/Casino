<?php

namespace App\Http\Controllers\User;

use App\Services\MoneyPrize;
use App\Services\Prize;
use App\Services\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Action after pressing button Play
     * @throws \Exception
     */
    public function getPrize(Request $request)
    {
        /** @var Prize $prize */
        $prize = \App\Services\Prize::generateRandomPrize();
        $user = $this->user;
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
        $user = $this->user;
        //transfer prize to user account
        $user->refusePrize($prize);

        //delete from session last gotten prize
        $request->session()->remove(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);

        return response()->json(
            [
                'view' => view('user.prize_refuse')->render()
            ],
            200
        );
    }


    public function convertMoneyPrize(Request $request)
    {
        $user = $this->user;
        /** @var MoneyPrize $prize last prize from session */
        $prize = $request->session()->get(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);

        //convert prize from money user account to bonus user account
        $convertedPrize = $user->convertPrize($prize);

        //we don't need it any more
        $request->session()->remove(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);

        $prizeName = $convertedPrize->getNameForView();

        return response()->json(
            [
                'view' => view('user.prize_convert', [
                    'prizeName' => $prizeName
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
