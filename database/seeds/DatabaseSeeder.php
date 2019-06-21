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
        factory(App\Models\User::class, 10)->create();

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
            'address' => 'Hà Nội',
        ]);

        DB::table('customer')->insert([
            'user_id' => 4,
            'coin' => 0,
            'address' => 'Đà Nẵng',
        ]);

        DB::table('customer')->insert([
            'user_id' => 5,
            'coin' => 0,
            'address' => 'Kiên Giang',
        ]);

        DB::table('customer')->insert([
            'user_id' => 6,
            'coin' => 0,
            'address' => 'Sóc Trăng',
        ]);

        DB::table('customer')->insert([
            'user_id' => 7,
            'coin' => 0,
            'address' => 'Cà Mau',
        ]);

        DB::table('customer')->insert([
            'user_id' => 8,
            'coin' => 0,
            'address' => 'Thừa Thiên Huế',
        ]);

        DB::table('customer')->insert([
            'user_id' => 9,
            'coin' => 0,
            'address' => 'Thành phố Hồ Chí Minh',
        ]);

        DB::table('customer')->insert([
            'user_id' => 10,
            'coin' => 0,
            'address' => 'Long An',
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
        factory(App\Models\Hotel::class, 20)->create();
        //User image
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/spider-man.png',
            'name' => 'spider-man',
            'is_primary' => 1,
            'user_id' => 3
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/dog2.png',
            'name' => 'dog2',
            'is_primary' => 1,
            'user_id' => 4
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/rainbow.png',
            'name' => 'rainbow',
            'is_primary' => 1,
            'user_id' => 5
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/1.jpg',
            'name' => 'cover1',
            'is_primary' => 2,
            'user_id' => 3
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/2.jpg',
            'name' => 'cover2',
            'is_primary' => 2,
            'user_id' => 4
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/face1.png',
            'name' => 'face1',
            'is_primary' => 1,
            'user_id' => 6
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/candy.png',
            'name' => 'candy',
            'is_primary' => 1,
            'user_id' => 7
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/dog1.png',
            'name' => 'dog1',
            'is_primary' => 1,
            'user_id' => 8
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/avatar1.png',
            'name' => 'avatar1',
            'is_primary' => 1,
            'user_id' => 9
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/dinosaur.png',
            'name' => 'dinosaur',
            'is_primary' => 1,
            'user_id' => 10
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/face3.png',
            'name' => 'face3',
            'is_primary' => 0,
            'user_id' => 4
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/3.jpg',
            'name' => 'cover3',
            'is_primary' => 2,
            'user_id' => 5
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/4.jpg',
            'name' => 'cover4',
            'is_primary' => 2,
            'user_id' => 6
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/5.jpg',
            'name' => 'cover5',
            'is_primary' => 2,
            'user_id' => 7
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/6.jpg',
            'name' => 'cover6',
            'is_primary' => 2,
            'user_id' => 8
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/6.jpg',
            'name' => 'cover6',
            'is_primary' => 2,
            'user_id' => 9
        ]);
        DB::table('user_image')->insert([
            'image_link'=>'http://localhost:8000/img/cover/6.jpg',
            'name' => 'cover6',
            'is_primary' => 2,
            'user_id' => 10
        ]);
        

    }
}
