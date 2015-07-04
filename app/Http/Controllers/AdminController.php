<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

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
}
