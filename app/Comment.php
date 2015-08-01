<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $table='comments';

    public function question(){
        return $this->belongsToOne('App\Question');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function dislikes()
    {
        return $this->hasMany('App\Dislike');
    }
}
