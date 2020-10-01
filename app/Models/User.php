<?php

namespace App\Models;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'users';
	public $incrementing = false;
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }
}
