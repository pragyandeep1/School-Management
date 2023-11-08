<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function index($userId){
        $user = User::where('id',$userId)->first();
     if ($user) {
        session()->put('impersonate',$user->id);
     }
    return redirect('/dashboard');
    }
    public function destroy(){   
        session()->forget('impersonate');
        return redirect('/dashboard');
    }
}
