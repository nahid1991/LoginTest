<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'questions';

    public function tags()
    {
        return $this->hasOne('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
