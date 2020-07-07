<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store($id)
   {
        //認証済みユーザがidのユーザをフォローする
        \Auth::user()->follow($id);
        //前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy($id)
    {
        //認証済みユーザがidのユーザをアンフォローする
        \Auth::user()->unfollow($id);
        //前のURLへリダイレクトさせる
        return back();
    }
}