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
    public function submitDelete(Request $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->input('user_id');

        $posts = Posts::where('user_id', $id)->get();

        $user = User::find($id);
        $userprofile = Profile::find($id);

        $favorites = $user->favorities()->get();

        $mess = "chua thuc hien";

        if ($favorites->isEmpty()) {
            if ($posts->isEmpty()){
                $user->delete();
                $userprofile->delete();
                $mess ="Xóa nguời dùng thành công";
            }
            else{
                $mess ="Không thể xóa do người dùng này có bài viết";
            }
        } else {
            $mess ="Không thể xóa do người dùng này có sở thích";
        }
        return redirect()->back()->with(['mess' => $mess]);

    }
}
