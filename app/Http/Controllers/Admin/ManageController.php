<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
