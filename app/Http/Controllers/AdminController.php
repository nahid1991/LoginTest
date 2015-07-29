<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use DB;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getEceFac(){
        $user = \Auth::user();
        $faculty = User::where('user_type', '=', '3')->where('dept_name', '=', 'ECE')->get();
        return view('ece', compact('faculty', 'user'));
    }

    public function getBbaFac(){
        $user = \Auth::user();
        $faculty = User::where('user_type', '=', '3')->where('dept_name', '=', 'BBA')->get();
        return view('bba', compact('faculty', 'user'));
    }

    public function getEngFac(){
        $user = \Auth::user();
        $faculty = User::where('user_type', '=', '3')->where('dept_name', '=', 'ENG')->get();
        return view('ece', compact('faculty', 'user'));
    }

    public function registration()
    {
        return view('file');
    }

    public function registerNow()
    {
//        echo "Working";
//        $file = array('name' => Input::file('name'));

        $file = Input::file('name')->getRealPath();
//        $content = \File::get($file);
        $lines = file($file, FILE_IGNORE_NEW_LINES);
//        echo(sizeof($lines));
        $j = 0;
        while($j < sizeof($lines))
        {
            $helper = (explode(" ", $lines[$j]));
            $emailverify = DB::table('users')
                ->where('email', '=', $helper[0])->get();
            $usernameverify = DB::table('users')
                ->where('username', '=', $helper[1])->get();
            if(!$emailverify || !$usernameverify){
                DB::table('users')->insert(
                    [
                        'email'     => $helper[0],
                        'username'  => $helper[1],
                        'password'  => bcrypt($helper[2]),
                        'user_type' => $helper[3],
                        'dept_name' => $helper[4],
                    ]);
            }

            $j++;
        }

//        $contentBreaker[] = explode("\n", $content);
//        echo($contentBreaker[0]);
//        foreach(explode("\n", $content)as $new)
//        {
//            $something = array($new);

//            foreach(explode(" ", $content_again) as $again)
//            {
//                $j = 0;
//                while($j <= sizeof($again))
//                {
//                    $helper[$j] = $again;
//                    $j++;
//                }
//                echo($helper[0]);
//                echo($helper[1]);
//                DB::table('users')->insert(
//                    [
//                        'email'     => $helper[0],
//                        'username'  => $helper[1],
//                        'password'  => bcrypt($helper[2]),
//                        'user_type' => $helper[3],
//                        'dept_name' => $helper[4],
//                    ]);
//            }
//        }
        return redirect('/registration');


    }
}
