<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\User;
use DB;
use Carbon\Carbon;


class QuestionController extends Controller {

	public function store(QuestionRequest $request)
	{
        $user = \Auth::user();
//        $verify = $request->input('tag_id');
//        echo($verify);
        DB::table('questions')->insert([
            'username'   => $user->username,
            'title'      => $request->input('title'),
            'body'       => $request->input('body'),
            'tag_id'     => $request->input('tag_id'),
            'created_at' => date("Y-m-d h:i:sa")
        ]);
        if($user->user_type == 2)
        {
            return redirect('/student');
        }

        if($user->user_type == 3)
        {
            return redirect('/dash-board');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($tag)
	{
        $user = \Auth::user();
        if($user->user_type == 3)
        {
            $tags = DB::table('tag_faculty')
                ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
                ->join('users', 'tag_faculty.username', '=', 'users.username')
                ->where('users.username', $user->username)
                ->get();

            $question = DB::table('questions')
                ->join('users', 'questions.username', '=', 'users.username')
                ->where('tag_id', '=', $tag)
                ->orderBy('questions.created_at', 'desc')
                ->get();
            return view('questions', compact('question', 'user', 'tags'));
//        echo($tag);
        }

        else{
            $tags = DB::table('tag_student')
                ->join('tags', 'tag_student.tag_id', '=', 'tags.id')
                ->join('users', 'tag_student.username', '=', 'users.username')
                ->where('users.username', $user->username)
                ->get();

            $question = DB::table('questions')
                ->join('users', 'questions.username', '=', 'users.username')
                ->where('tag_id', '=', $tag)
                ->orderBy('questions.created_at', 'desc')
                ->get();
            return view('questionofstudent', compact('question', 'user', 'tags'));
//            echo($tag);
        }
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

}
