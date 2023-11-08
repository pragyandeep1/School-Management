<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;
use App\Models\School;


class UserController extends Controller
{
   public function addUser(){
      return view('admin/user/user');
   }// end function

   public function save(Request $request){
      $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
        ]);
         //dd($request->all()); exit;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'   => $request->role,
        ]);

        return redirect()->back()->with('success', 'User created Successful'); 
   }// end function

   public function update(){

   }// end function

   public function userList(Request $request){
      $users = User::orderBy('created_at', 'desc')->get();
      return view('admin/user/user_list',['users'=>$users]);
   }// end function

   public function active(Request $request, $id)
    {
        User::where('id', $id)->update(['status' => 0]);
        return redirect('/user-list')->with('danger', 'User Status Inactive');
    }// end function

   public function inactive(Request $request, $id)
    {
       User::where('id', $id)->update(['status' => 1]);
       return redirect('/user-list')->with('success', 'User Status Active');
    }// end function

    public function getUserCount()
    {
        $userCount = User::count();
        return response()->json(['userCount' => $userCount]);
    }// end function

}
