<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models;
use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
	$user_id = App\Models\User::pluck('id')->toArray();
    /*method randomly shuffles the items */
    shuffle($user_id);

    return [
    	'title' => $faker->text(10),
    	'desc' => $faker->text(50),
    	'user_id' => $user_id[0],
    ];
});
