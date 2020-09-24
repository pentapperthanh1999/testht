<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'desc', 'email', 'user_id'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'name');
    }
}
