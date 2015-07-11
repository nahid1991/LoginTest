<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use App\Tag;

class DashBoardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */



    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $intag = Tag::lists('name', 'id');
        $user = \Auth::user();
        $intag = DB::table('tag_faculty')
            ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
            ->where('username', $user->username)
            ->lists('name', 'tag_id');
        $tags = DB::table('tag_faculty')
            ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
            ->join('users', 'tag_faculty.username', '=', 'users.username')
            ->where('users.username', $user->username)
            ->get();
        return view('dashboard', compact('tags', 'user', 'intag'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
//	public function create()
//	{
//		//
//	}
//
//	/**
//	 * Store a newly created resource in storage.
//	 *
//	 * @return Response
//	 */
//	public function store()
//	{
//		//
//	}
//
//	/**
//	 * Display the specified resource.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function show($id)
//	{
//		//
//	}
//
//	/**
//	 * Show the form for editing the specified resource.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function edit($id)
//	{
//		//
//	}
//
//	/**
//	 * Update the specified resource in storage.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function update($id)
//	{
//		//
//	}
//
//	/**
//	 * Remove the specified resource from storage.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function destroy($id)
//	{
//		//
//	}

    public function student(){
//        $intag = Tag::lists('name', 'id');

        $user = \Auth::user();

        $all = Tag::lists('name', 'id');
        $intag = DB::table('tag_student')
            ->join('tags', 'tag_student.tag_id', '=', 'tags.id')
            ->where('username', $user->username)
            ->lists('name', 'tag_id');
        $tagStudent = DB::table('tag_student')
            ->join('tags', 'tag_student.tag_id', '=', 'tags.id')
            ->where('username', $user->username)->get();
        return view('student', compact('user','intag', 'tagStudent', 'all'));
    }

}
