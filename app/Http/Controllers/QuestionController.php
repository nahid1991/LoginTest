<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\User;
use DB;

class QuestionController extends Controller {

	public function store(QuestionRequest $request)
	{
        $user = \Auth::user();
//        $verify = $request->input('tag_id');
//        echo($verify);
        DB::table('questions')->insert([
            'username' => $user->username,
            'title'    => $request->input('title'),
            'body'     => $request->input('body'),
            'tag_id'   => $request->input('tag_id'),
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

}
