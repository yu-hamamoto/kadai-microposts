<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    public function index()
    {
        $data=[];
        if(\Auth::check()){//認証済みの場合
        //認証済みユーザを取得
        $user=\Auth::user();
        //ユーザの投稿一覧を作成日時の降順で取得
        $microposts=$user->feed_microposts()->orderBy('created_at','desc')->paginate(10);
        
        $data=[
            'user'=>$user,
            'microposts'=>$microposts,
            ];
    }
    
    //Welcome1ビューでそれらを表示
    return view('welcome',$data);
   }
   
   public function store(Request $request)
   {
       //バリテーション
       $request->validate([
           'content'=>'required|max:255',
        ]);
           
        //認証済みデータ（閲覧者)の投稿として作成(リクエストされた値をもとに作成)
        $request->user()->microposts()->create([
            'content'=>$request->content,
        ]);
               
        //前のURLへリダイレクトさせる
        return back();
   }  
               
    public function destroy($id)
    {
        $micropost= \App\Micropost::findOrFail($id);
               
        //認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if(\Auth::id() === $micropost->user_id){
            $micropost->delete();
            
             return view('micropost_favorite.favorite_button',[
            'micropost'=>$micropost,
            ]);
        }
               
        //前のURLへリダイレクトさせる
        return back();
    }    
}   