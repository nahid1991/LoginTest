<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class PassResetController extends Controller {

    public function index()
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

            return view('otherspassword', compact('user', 'tags'));
        }

        if($user->user_type == 1)
        {
            return view('adminpassword');
        }

        if($user->user_type == 2)
        {
            return view('studentpass');
        }
    }

    public function postPass()
    {
        $user = \Auth::user();
//        DB::table('users')->where('username', '=', $user->username)->delete('password');
        DB::table('users')->where('username', '=', $user->username)
            ->update(['password' => bcrypt(Input::get('passwordNew'))]);
        if($user->user_type == 1)
        {
            return redirect('/reset');
        }

        else{
            return redirect('/reset');
        }
    }

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
        return view('name');
    }


}
