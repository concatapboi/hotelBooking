<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //User
        factory(App\Models\User::class, 4)->create();

        //Hotel manager
        DB::table('hotel_manager')->insert([
            'user_id' => 1,
        ]);

        DB::table('hotel_manager')->insert([
            'user_id' => 2,
        ]);

        DB::table('customer')->insert([
            'user_id' => 3,
            'coin' => 0,
            'address' => 'Moon Palace',
        ]);

        DB::table('customer')->insert([
            'user_id' => 4,
            'coin' => 0,
            'address' => 'Mars Palace',
        ]);

        //Admin
        factory(App\Models\Admin::class, 1)->create();

        //Hotel type
        DB::table('hotel_type')->insert([
            'id' => 1,
            'name' => 'Business Hotel',
            'meta_name' => 'business-hotel',
        ]);

        DB::table('hotel_type')->insert([
            'id' => 2,
            'name' => 'Resort Hotel',
            'meta_name' => 'resort-hotel',
        ]);

        DB::table('hotel_type')->insert([
            'id' => 3,
            'name' => 'Homestay',
            'meta_name' => 'homestay',
        ]);

        DB::table('hotel_type')->insert([
            'id' => 4,
            'name' => 'Airport Hotel',
            'meta_name' => 'airport-hotel',
        ]);

        DB::table('hotel_type')->insert([
            'id' => 5,
            'name' => 'Mini Hotel',
            'meta_name' => 'mini-hotel',
        ]);

        DB::table('hotel_type')->insert([
            'id' => 6,
            'name' => 'Spa Hotel',
            'meta_name' => 'spa-hotel',
        ]);

        DB::table('hotel_type')->insert([
            'id' => 7,
            'name' => 'Serviced Apartment',
            'meta_name' => 'serviced-apartment',
        ]);

        //Hotel
        factory(App\Models\Hotel::class, 3)->create();

    }
}
