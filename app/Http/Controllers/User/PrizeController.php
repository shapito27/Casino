<?php

namespace App\Http\Controllers\User;

use App\Services\MoneyPrize;
use App\Services\Prize;
use App\Services\PrizeGenerator;
use App\Services\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    /** @var User  */
    private $user;
    /** @var PrizeGenerator  */
    private $prizeGenerator;

    public function __construct(User $user, PrizeGenerator $prizeGenerator)
    {
        $this->user = $user;
        $this->prizeGenerator = $prizeGenerator;
    }

    /**
     * Action after pressing button Play
     * @throws \Exception
     */
    public function getPrize(Request $request)
    {
        $this->user->setId($this->user->getCurrentUserId());

        //win prize and transfer  to user account
        $prize = $this->user->winPrize($this->prizeGenerator);

        $prizeName = $prize->getNameForView();

        $request->session()->put(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE, $prize);

        return response()->json(
            [
                'view' => view('user.prize', [
                    'prizeName' => $prizeName,
                    'prizeId' => $prize->getValue(),
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

        $this->user->setId($this->user->getCurrentUserId());

        //transfer prize to user account
        $this->user->refusePrize($prize);

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
        /** @var MoneyPrize $prize last prize from session */
        $prize = $request->session()->get(Prize::SESSION_VAR_LAST_GOTTENN_PRIZE);

        $this->user->setId($this->user->getCurrentUserId());

        //convert prize from money user account to bonus user account
        $convertedPrize = $this->user->convertPrize($prize);

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
