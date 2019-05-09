<?php

use Illuminate\Support\Str;
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
$factory->define(App\Models\User::class, function (Faker $faker) {
    static $number =1;
    return [
        'name' => $faker->name,
        'username' => 'user'.$number++,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->tollFreePhoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$12$KgenwKsWJNYfdVRm/qZnu.NTXu6s9aojQt5sVB9H7QpprpEjrBg86', // secret
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => '$2y$12$KgenwKsWJNYfdVRm/qZnu.NTXu6s9aojQt5sVB9H7QpprpEjrBg86', // secret
        'remember_token' => Str::random(10),
    ];
});
