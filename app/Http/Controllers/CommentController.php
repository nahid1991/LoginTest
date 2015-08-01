<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;

use Illuminate\Http\Request;
use DB;
use App\Comment;

class CommentController extends Controller {

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
	public function store(CommentRequest $request)
	{
        $user = \Auth::user();

        DB::table('comments')->insert([
            'username'     => $user->username,
            'comment_body' => $request->input('comment_body'),
            'q_id'         => $request->input('q_id'),
            'created_at'   => date("Y-m-d h:i:sa")
        ]);



        return redirect('/details/'.$request->input('q_id'));
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

    public function liked($id)
    {
//        echo($id);
        $user = \Auth::user();
        $link = DB::table('comments')
            ->join('questions', 'questions.que_id', '=', 'comments.q_id')
            ->where('comment_id', '=', $id)
            ->first();



        $verify = DB::table('likes')
            ->where('username', '=', $user->username)
            ->where('cmnt_id', '=', $id)
            ->get();

        $likeverify = DB::table('dislikes')
            ->where('username', '=', $user->username)
            ->where('cmnt_id', '=', $id)
            ->get();




        if(!$verify)
        {
            if($likeverify)
            {
                DB::table('dislikes')
                    ->where('username', '=', $user->username)
                    ->where('cmnt_id', '=', $id)
                    ->delete();

                DB::table('comments')
                    ->where('comment_id', '=', $id)
                    ->decrement('comment_dislikes', 1);
            }

            DB::table('likes')
                ->insert([
                    'username'   => $user->username,
                    'cmnt_id'    => $id,
                ]);



            DB::table('comments')
                ->where('comment_id', '=', $id)
                ->increment('comment_likes', 1);

            return redirect('/details/'.$link->que_id);

        }

        if($verify)
        {
            DB::table('likes')
                ->where('username', '=', $user->username)
                ->where('cmnt_id', '=', $id)
                ->delete();

            DB::table('comments')
                ->where('comment_id', '=', $id)
                ->decrement('comment_likes', 1);

            return redirect('/details/'.$link->que_id);

        }








    }

    public function disliked($id)
    {
//        echo($id);
        $user = \Auth::user();

        $link = DB::table('comments')
            ->join('questions', 'questions.que_id', '=', 'comments.q_id')
            ->where('comment_id', '=', $id)
            ->first();



        $verify = DB::table('dislikes')
            ->where('username', '=', $user->username)
            ->where('cmnt_id', '=', $id)
            ->get();

        $likeverify = DB::table('likes')
            ->where('username', '=', $user->username)
            ->where('cmnt_id', '=', $id)
            ->get();




        if(!$verify)
        {
            if($likeverify)
            {
                DB::table('likes')
                    ->where('username', '=', $user->username)
                    ->where('cmnt_id', '=', $id)
                    ->delete();

                DB::table('comments')
                    ->where('comment_id', '=', $id)
                    ->decrement('comment_likes', 1);
            }

            DB::table('dislikes')
                ->insert([
                    'username'   => $user->username,
                    'cmnt_id'    => $id,
                ]);



            DB::table('comments')
                ->where('comment_id', '=', $id)
                ->increment('comment_dislikes', 1);

            return redirect('/details/'.$link->que_id);

        }

        if($verify)
        {
            DB::table('dislikes')
                ->where('username', '=', $user->username)
                ->where('cmnt_id', '=', $id)
                ->delete();

            DB::table('comments')
                ->where('comment_id', '=', $id)
                ->decrement('comment_dislikes', 1);

            return redirect('/details/'.$link->que_id);

        }



    }

}
