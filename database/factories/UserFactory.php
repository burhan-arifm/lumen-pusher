<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $gender = ['male', 'female'];
    $email = [$faker->email, $faker->safeEmail, $faker->freeEmail];
    $dob = $faker->date($format = 'Y-m-d', $max = 'now');

    return [
        'name' => $faker->name($gender[array_rand($gender)]),
        'date_of_birth' => $dob,
        'gender' => $gender[array_rand($gender)],
        'address' => $faker->address,
        'email' => $email[array_rand($email)],
        'job' => Carbon::parse($dob)->diffInYears(Carbon::now()) >= 18 ? $faker->jobTitle : 'student'
    ];
});
