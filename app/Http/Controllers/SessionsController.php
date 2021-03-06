<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);

       if (Auth::attempt($credentials)) {
           session()->flash('success', '歡迎！');
           return redirect()->route('users.show', [Auth::user()]);
       } else {
           session()->flash('danger', '很抱歉，您的email和密碼不相符');
           return redirect()->back()->withInput();
       }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '登出成功！');
        return redirect('login');
    }

}