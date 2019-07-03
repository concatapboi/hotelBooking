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
    static $number = 1;
    return [
        'name' => $faker->name,
        'username' => 'user' . $number++,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->tollFreePhoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$12$82PIBhK8MovKXkLUNkyb7Omctq6jR3F3ROkjtb0JcArXpllvX2bXO', // secret
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => '$2y$12$82PIBhK8MovKXkLUNkyb7Omctq6jR3F3ROkjtb0JcArXpllvX2bXO', // secret
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Models\Hotel::class, function (Faker $faker) {
    static $no = 1;
    return [
        'verified' => rand(0, 1),
        'credit_card' => $faker->creditCardNumber,
        'rank_point' => $no,
        'name' => $faker->lastName,
        'description' => $faker->text($maxNbChars = 1200),
        'stars_num' => rand(0, 5),
        'meta_name' => 'hotel',
        'email' => $faker->email,
        'child_age' => '13',
        'tax_code' => 'IT98746784967' . $no++,
        'review_point' => 0,
        'fax_number' => '71937729' . $no,
        'phone_number' => $faker->phoneNumber,
        'coin' => 1000000,
        'hotel_type_id' => rand(1, 7),
        'hotel_manager_id' => 1,
        'ward_id' => 1,
        'address' => $faker->address,
    ];
});
$factory->define(App\Models\Room::class, function (Faker $faker) {
    static $no = 1;
    if ($no > 4) $no = 1;
    return [
        'room_name' => $faker->lastName,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'price' => rand(5, 100000),
        'max_adult_amount' => rand(2,5),
        'max_child_amount' => $faker->randomDigit,
        'free_child_amount' => $faker->randomDigit,
        'room_size' => rand(50,200),
        'amount' => rand(1,10),
        'room_mode_id' => $no++,
        'room_type_id' => 1,
        'hotel_id' => rand(1, 5),
    ];
});
$factory->define(App\Models\RoomBedType::class, function (Faker $faker) {
    static $no = 1, $noB = 1;
    if ($noB > 5) $noB = 1;
    return [
        'bed_type_id' => $noB++,
        'room_id' => $no++,
        'amount' => rand(1, 2)
    ];
});
$factory->define(App\Models\RoomFeature::class, function (Faker $faker) {
    static $no = 1, $noF = 1;
    if ($noF > 4) $noF = 1;
    return [
        'feature_id' => $noF++,
        'room_id' => $no++
    ];
});
$factory->define(App\Models\ServiceRoomType::class, function (Faker $faker) {
    static $no = 1;
    if ($no > 5) $no = 1;
    return [
        'service_id' => $no++,
        'room_type_id' => 1,
        'hotel_id' => 1
    ];
});
$factory->define(App\Models\BookingStatus::class, function (Faker $faker) {
    return [
        'name'=> 'Wait for confirmation'
    ];
});
$factory->define(App\Models\PaymentMethod::class, function (Faker $faker) {
    return [
        'name' => 'Offline'
    ];
});
