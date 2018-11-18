<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrizeController extends Controller
{
    public function getPrize()
    {
        return 'результат игры';
    }

    public function play()
    {
        return view('user.prize');
    }
}
