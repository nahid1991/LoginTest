<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class NameResetController extends Controller {

    public function name()
    {
        $user = \Auth::user();
        if($user->user_type == 3)
        {
            $user = \Auth::user();
            $tags = DB::table('tag_faculty')
                ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
                ->join('users', 'tag_faculty.username', '=', 'users.username')
                ->where('users.username', $user->username)
                ->get();

            return view('name', compact('user', 'tags'));
        }
        return view('studentname');
    }

    public function changeName()
    {
        $user = \Auth::user();
//        DB::table('users')->where('username', '=', $user->username)->delete('password');
        DB::table('users')->where('username', '=', $user->username)
            ->update(['real_name' => Input::get('name')]);
        return redirect('/dash-board');
    }
}
