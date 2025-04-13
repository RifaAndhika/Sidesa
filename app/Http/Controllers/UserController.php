<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_contrroller_view(){
        return view('pages.account-request.index');
    }
}
