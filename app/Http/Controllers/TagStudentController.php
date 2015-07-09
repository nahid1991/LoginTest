<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class TagStudentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

        $user = \Auth::user();
        $tagStudent = $request->input('tag_id');
        $check = DB::table('tag_student')
            ->where('tag_student.tag_id', $tagStudent )
            ->where('tag_student.username', $user->username)
            ->get();
        $count = DB::table('tag_student')->where('username', $user->username)->count();
        if($count < 6)
        {
//            echo($tagStudent);
            if(!$check)
            {
                DB::table('tag_student')->insert([
                    'tag_id'   => $tagStudent,
                    'username' => $user->username,
                ]);
                return redirect('/student');
            }

            else{
                $error = "Tag name under your profile already exists";
                return redirect('/student')->withErrors($error);
            }
        }

        else {
            $error = "Your tag limit has exceeded";

            return redirect('/student')->withErrors($error);
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getDelete($tag)
    {
//        echo($tag);
//        $tag = Tag::find($tag);
////        $newTags = DB::table('tags')->where('name', $tag)->first();
//////        echo($newTags);
////        $oneMore = DB::table('tags')
////            ->join('tag_faculty', 'tags.id', '=', $newTags)
////            ->first();
////        $user = \Auth::user();
////
////
//        if(!$tag)
//        {
//            echo ($tag);
//        }
//        else{
//            $tag->delete();
//            return redirect('/dash-board');
//        }



        DB::table('tag_student')
            ->where('tag_id', $tag)
            ->delete();
        return redirect('/student');
    }

}
