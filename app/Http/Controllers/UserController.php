<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function account_request_view(){

        $users = User::where('status', 'submitted')->get();
return view('pages.account-request.index', [
    'users' => $users,
]);
    }
}
