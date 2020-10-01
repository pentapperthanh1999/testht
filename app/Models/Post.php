<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';
	public $incrementing = false;
	protected $fillable = ['title', 'desc', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
