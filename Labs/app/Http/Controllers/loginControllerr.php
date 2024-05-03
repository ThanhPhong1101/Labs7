<?php


namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;


class loginControllerr
{
    public function xuatNguoiDung()
    {
        $users = User::all();
        return view('login', ['users' => $users]);
    }
    public function submitForm(Request $request)
    {
        $userID = $request->input('user_id');

        $users = User::where('id', $userID)->get();
        $posts = Posts::where('user_id', $userID)->get();

        $user = User::find($userID);
        $favorites = $user->favorities()->get();

        $profile = $user->profile;

        return redirect()->back()->with(['result' => $posts, 'idnguoidung'=> $users, 'sothich' => $favorites, 'profile' => $profile]);
    }
    public function submitDelete($id)
    {
        $user = User::find($id);

        $HashPost = Posts::where('user_id',$user->id)->exists();

        $favorites = $user->favorities()->exists();
        $profile = $user->profile;
        if($HashPost||$favorites){
            return redirect('/')->with('mess','Khong xoa dc');
        }
        User::destroy($id);
        Profile::destroy($id);

        return redirect('/')->with('mess','Xoa dc');
    }
}
