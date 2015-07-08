<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;

use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use DB;


class TagController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = \Auth::user();
        $tags = DB::table('tag_faculty')
            ->join('users', 'tag_faculty.username', '=', 'users.username')
            ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
            ->where('users.username', $user->username)
            ->get();
        return view('dashboard', compact('tags', 'user'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//        $user = \Auth::user();
//        $tags = DB::table('tag_faculty')
//            ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
//            ->join('users', 'tag_faculty.username', '=', 'users.username')
//            ->where('users.username', $user->username)
//            ->get();
//        return view('tag', compact('tags', 'user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TagRequest $request)
	{
        $user = \Auth::user();


//        $newTags = array();
//        foreach(explode(" ", $request->input("name")) as $new)
//        {
//            $newTags = array("name" => $new);
//            Tag::create($newTags);
//        }
        $count = DB::table('tag_faculty')->where('username', $user->username)->count();
        if($count < 4)
        {
            Tag::create($request->all());
            $forQuery = Tag::orderBy('created_at', 'desc')->first();

            DB::table('tag_faculty')->insert(
                ['tag_id' => $forQuery->id, 'username' => $user->username]
            );
//            $tags = DB::table('tag_faculty')
//                ->join('tags', 'tag_faculty.tag_id', '=', 'tags.id')
//                ->join('users', 'tag_faculty.username', '=', 'users.username')
//                ->where('users.username', $user->username)
//                ->get();
            return redirect('/dash-board');

        }

        else {
            $error = "Your tag limit has exceeded";

            return redirect('/dash-board')->withErrors($error);
        }




//        dd($request->input('tags'));

//        Tag::create($request->all());



	}




    public function getDelete($tag)
    {
        //echo($tag);
        $tag = Tag::find($tag);
//        $newTags = DB::table('tags')->where('name', $tag)->first();
////        echo($newTags);
//        $oneMore = DB::table('tags')
//            ->join('tag_faculty', 'tags.id', '=', $newTags)
//            ->first();
//        $user = \Auth::user();
//
//
        if(!$tag)
        {
            echo ($tag);
        }
        else{
            $tag->delete();
            return redirect('/dash-board');
        }
    }
}
