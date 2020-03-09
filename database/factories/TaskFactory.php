<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Task::class, function (Faker $faker) {
    $users = \App\Models\User::get()->pluck('id')->toArray();
    $statuses = \App\Models\Status::get()->pluck('id')->toArray();
    $timestamp = mt_rand(strtotime("01-03-2020"), strtotime("01-05-2020"));
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'text' => $faker->text,
        'created_by' => \Illuminate\Support\Arr::get($users, array_rand($users)),
        'assigned_to' => \Illuminate\Support\Arr::get($users, array_rand($users)),
        'status_id' => \Illuminate\Support\Arr::get($statuses, array_rand($statuses)),
        'deadline' => date("Y-m-d", $timestamp)
    ];;
});
