<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $table = 'likes';

    public function comment()
    {
        return $this->belongsToMany('App\Comment');
    }

    public function question()
    {
        return $this->belongsToMany('App\Question');
    }

}
