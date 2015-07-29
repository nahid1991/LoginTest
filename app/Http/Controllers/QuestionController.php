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

    public function details($id)
    {
//        echo($id);
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
                ->join('tags', 'questions.tag_id', '=', 'tags.id')
                ->where('questions.que_id', $id)
                ->get();
            $comment = DB::table('comments')
                ->join('questions', 'comments.q_id', '=', 'questions.que_id')
                ->join('users', 'comments.username', '=', 'users.username')
                ->where('q_id', '=', $id)
                ->orderBy('comments.created_at', 'asc')
                ->get();
            return view('detailsfaculty', compact('user', 'tags', 'question', 'comment'));
        }

        if($user->user_type == 2)
        {
            $tagStudent = DB::table('tag_student')
                ->join('tags', 'tag_student.tag_id', '=', 'tags.id')
                ->join('users', 'tag_student.username', '=', 'users.username')
                ->where('users.username', $user->username)
                ->get();
            $question = DB::table('questions')
                ->join('users', 'questions.username', '=', 'users.username')
                ->join('tags', 'questions.tag_id', '=', 'tags.id')
                ->where('questions.que_id', $id)
                ->get();
            $comment = DB::table('comments')
                ->join('questions', 'comments.q_id', '=', 'questions.que_id')
                ->join('users', 'comments.username', '=', 'users.username')
                ->where('q_id', '=', $id)
                ->orderBy('comments.created_at', 'asc')
                ->get();
            return view('detailsstudent', compact('user', 'tagStudent', 'question', 'comment'));
        }
    }

    public function liked($id)
    {
//        echo($id);
        $user = \Auth::user();

        $verify = DB::table('likes')
            ->where('username', '=', $user->username)
            ->where('q_id', '=', $id)
            ->get();

        $likeverify = DB::table('dislikes')
            ->where('username', '=', $user->username)
            ->where('q_id', '=', $id)
            ->get();

        if(!$verify)
        {
            if($likeverify)
            {
                DB::table('dislikes')
                    ->where('username', '=', $user->username)
                    ->where('q_id', '=', $id)
                    ->delete();

                DB::table('questions')
                    ->join('users', 'questions.username', '=', 'users.username')
                    ->join('tags', 'questions.tag_id', '=', 'tags.id')
                    ->where('questions.que_id', $id)
                    ->decrement('dislikes', 1);
            }

            DB::table('likes')
                ->insert([
                    'username' => $user->username,
                    'q_id'     => $id,
                ]);



            DB::table('questions')
                ->join('users', 'questions.username', '=', 'users.username')
                ->join('tags', 'questions.tag_id', '=', 'tags.id')
                ->where('questions.que_id', $id)
                ->increment('likes', 1);


//            if($user->user_type == 2)
//            {
//                $tagStudent = DB::table('tag_student')
//                    ->join('tags', 'tag_student.tag_id', '=', 'tags.id')
//                    ->join('users', 'tag_student.username', '=', 'users.username')
//                    ->where('users.username', $user->username)
//                    ->get();
//                $question = DB::table('questions')
//                    ->join('users', 'questions.username', '=', 'users.username')
//                    ->join('tags', 'questions.tag_id', '=', 'tags.id')
//                    ->where('questions.que_id', $id)
//                    ->get();
//                return view('detailsstudent', compact('user', 'tagStudent', 'question'));
//            }
//
//
//            if($user->user_type == 3)
//            {
//                $tags = DB::table('tag_faculty')
//                    ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
//                    ->join('users', 'tag_faculty.username', '=', 'users.username')
//                    ->where('users.username', $user->username)
//                    ->get();
//                $question = DB::table('questions')
//                    ->join('users', 'questions.username', '=', 'users.username')
//                    ->join('tags', 'questions.tag_id', '=', 'tags.id')
//                    ->where('questions.que_id', $id)
//                    ->get();
//                return view('detailsfaculty', compact('user', 'tags', 'question'));
//            }
            return redirect('/details/'.$id);

        }

        if($verify)
        {
            DB::table('likes')
                ->where('username', '=', $user->username)
                ->where('q_id', '=', $id)
                ->delete();

            DB::table('questions')
                ->join('users', 'questions.username', '=', 'users.username')
                ->join('tags', 'questions.tag_id', '=', 'tags.id')
                ->where('questions.que_id', $id)
                ->decrement('likes', 1);


//            if($user->user_type == 2)
//            {
//                $tagStudent = DB::table('tag_student')
//                    ->join('tags', 'tag_student.tag_id', '=', 'tags.id')
//                    ->join('users', 'tag_student.username', '=', 'users.username')
//                    ->where('users.username', $user->username)
//                    ->get();
//                $question = DB::table('questions')
//                    ->join('users', 'questions.username', '=', 'users.username')
//                    ->join('tags', 'questions.tag_id', '=', 'tags.id')
//                    ->where('questions.que_id', $id)
//                    ->get();
//                return view('detailsstudent', compact('user', 'tagStudent', 'question'));
//            }
//
//
//            if($user->user_type == 3)
//            {
//                $tags = DB::table('tag_faculty')
//                    ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
//                    ->join('users', 'tag_faculty.username', '=', 'users.username')
//                    ->where('users.username', $user->username)
//                    ->get();
//                $question = DB::table('questions')
//                    ->join('users', 'questions.username', '=', 'users.username')
//                    ->join('tags', 'questions.tag_id', '=', 'tags.id')
//                    ->where('questions.que_id', $id)
//                    ->get();
//                return view('detailsfaculty', compact('user', 'tags', 'question'));
//            }
            return redirect('/details/'.$id);
        }

    }










    public function disliked($id)
    {
//        echo($id);
        $user = \Auth::user();

        $verify = DB::table('dislikes')
            ->where('username', '=', $user->username)
            ->where('q_id', '=', $id)
            ->get();

        $likeverify = DB::table('likes')
            ->where('username', '=', $user->username)
            ->where('q_id', '=', $id)
            ->get();



        if(!$verify)
        {

            if($likeverify)
            {
                DB::table('likes')
                    ->where('username', '=', $user->username)
                    ->where('q_id', '=', $id)
                    ->delete();

                DB::table('questions')
                    ->join('users', 'questions.username', '=', 'users.username')
                    ->join('tags', 'questions.tag_id', '=', 'tags.id')
                    ->where('questions.que_id', $id)
                    ->decrement('likes', 1);
            }

            DB::table('dislikes')
                ->insert([
                    'username' => $user->username,
                    'q_id'     => $id,
                ]);


            DB::table('questions')
                ->join('users', 'questions.username', '=', 'users.username')
                ->join('tags', 'questions.tag_id', '=', 'tags.id')
                ->where('questions.que_id', $id)
                ->increment('dislikes', 1);


            return redirect('/details/'.$id);
        }


        if($verify)
        {
            DB::table('dislikes')
                ->where('username', '=', $user->username)
                ->where('q_id', '=', $id)
                ->delete();


            DB::table('questions')
                ->join('users', 'questions.username', '=', 'users.username')
                ->join('tags', 'questions.tag_id', '=', 'tags.id')
                ->where('questions.que_id', $id)
                ->decrement('dislikes', 1);

            return redirect('/details/'.$id);
        }

    }

}
