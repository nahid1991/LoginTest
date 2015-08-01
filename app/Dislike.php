<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model {

	protected $table = 'dislikes';

    public function comment()
    {
        return $this->belongsToMany('App\Comment');
    }

    public function question()
    {
        return $this->belongsToMany('App\Question');
    }
}
