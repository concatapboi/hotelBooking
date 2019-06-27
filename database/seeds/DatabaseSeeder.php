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
        //User: 10
        factory(App\Models\User::class, 10)->create();

        //Hotel manager: 2
        DB::table('hotel_manager')->insert([
            'user_id' => 1,
        ]);
        DB::table('hotel_manager')->insert([
            'user_id' => 2,
        ]);
        //Customer: 8
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

        //Admin:1 
        factory(App\Models\Admin::class, 1)->create();

        //Hotel type: 7
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

        //User image: 17
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/spider-man.png',
            'name' => 'spider-man',
            'is_primary' => 1,
            'user_id' => 3
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/dog2.png',
            'name' => 'dog2',
            'is_primary' => 1,
            'user_id' => 4
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/rainbow.png',
            'name' => 'rainbow',
            'is_primary' => 1,
            'user_id' => 5
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/1.jpg',
            'name' => 'cover1',
            'is_primary' => 2,
            'user_id' => 3
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/2.jpg',
            'name' => 'cover2',
            'is_primary' => 2,
            'user_id' => 4
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/face1.png',
            'name' => 'face1',
            'is_primary' => 1,
            'user_id' => 6
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/candy.png',
            'name' => 'candy',
            'is_primary' => 1,
            'user_id' => 7
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/dog1.png',
            'name' => 'dog1',
            'is_primary' => 1,
            'user_id' => 8
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/avatar1.png',
            'name' => 'avatar1',
            'is_primary' => 1,
            'user_id' => 9
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/dinosaur.png',
            'name' => 'dinosaur',
            'is_primary' => 1,
            'user_id' => 10
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/face3.png',
            'name' => 'face3',
            'is_primary' => 0,
            'user_id' => 4
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/3.jpg',
            'name' => 'cover3',
            'is_primary' => 2,
            'user_id' => 5
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/4.jpg',
            'name' => 'cover4',
            'is_primary' => 2,
            'user_id' => 6
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/5.jpg',
            'name' => 'cover5',
            'is_primary' => 2,
            'user_id' => 7
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/6.jpg',
            'name' => 'cover6',
            'is_primary' => 2,
            'user_id' => 8
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/6.jpg',
            'name' => 'cover6',
            'is_primary' => 2,
            'user_id' => 9
        ]);
        DB::table('user_image')->insert([
            'image_link' => 'http://localhost:8000/img/cover/6.jpg',
            'name' => 'cover6',
            'is_primary' => 2,
            'user_id' => 10
        ]);

        //Room Mode: 4
        DB::table('room_mode')->insert([
            'name' => 'Solo traveler',
            'status' => 1,
        ]);
        DB::table('room_mode')->insert([
            'name' => 'Couple/Pair',
            'status' => 1,
        ]);
        DB::table('room_mode')->insert([
            'name' => 'Family travelers',
            'status' => 1,
        ]);
        DB::table('room_mode')->insert([
            'name' => 'Group travelers',
            'status' => 1,
        ]);

        //Room type: 4
        DB::table('room_type')->insert([
            'name' => 'Standard',
            'description' => 'Standard',
            'status' => 1,
        ]);
        DB::table('room_type')->insert([
            'name' => 'Superior',
            'description' => 'Superior',
            'status' => 1,
        ]);
        DB::table('room_type')->insert([
            'name' => 'Deluxe',
            'description' => 'Deluxe',
            'status' => 1,
        ]);
        DB::table('room_type')->insert([
            'name' => 'Suite',
            'description' => 'Suite',
            'status' => 1,
        ]);

        //Bed Type: 5
        DB::table('bed_type')->insert([
            'name' => 'Single bed',
            'width' => '120',
            'length' => '190',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'Double bed',
            'width' => '150',
            'length' => '190',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'Queen bed',
            'width' => '160',
            'length' => '200',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'King bed',
            'width' => '180',
            'length' => '200',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'Bunk bed',
            'width' => '120',
            'length' => '190',
            'status' => 1,
        ]);

        //Room services: 5
        DB::table('service')->insert([
            'name' => 'Free Wi-Fi',
            'meta_name' => 'free-wifi',
            'icon' => 'wifi',
            'status' => true,
        ]);
        DB::table('service')->insert([
            'name' => 'Free breakfast',
            'meta_name' => 'free-breakfast',
            'icon' => 'utensils',
            'status' => true,
        ]);
        DB::table('service')->insert([
            'name' => 'Bar',
            'meta_name' => 'bar',
            'icon' => 'glass-martini-alt',
            'status' => true,
        ]);
        DB::table('service')->insert([
            'name' => 'Laundry rooms',
            'meta_name' => 'laundry',
            'icon' => 'caret-square-down',
            'status' => true,
        ]);
        DB::table('service')->insert([
            'name' => '24-Hour Front Desk',
            'meta_name' => 'front-desk',
            'icon' => 'concierge-bell',
            'status' => true,
        ]);

        //Feature: 4
        DB::table('feature')->insert([
            'name' => 'Televison',
            'meta_name' => 'tv',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Air conditioning',
            'meta_name' => 'ac',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'In-room safe',
            'meta_name' => 'safe',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Hair dryer',
            'meta_name' => 'hair-dryer',
            'status' => true,
        ]);

        //Hotel: 5
        factory(App\Models\Hotel::class, 5)->create();

        //Room: 40
        for ($h = 1; $h <= 5; $h++) {
            for ($rT = 1; $rT <= 4; $rT++) {
                factory(App\Models\Room::class, 2)->create([
                    'hotel_id' => $h,
                    'room_type_id' => $rT
                ]);
                $noS = rand(3, 5);
                for ($s = 1; $s <= $noS; $s++) {
                    factory(App\Models\ServiceRoomType::class)->create([
                        'room_type_id' => $rT,
                        'hotel_id' => $h
                    ]);
                }
            }
        }
        //RoomBedType:
        for ($r = 1; $r <= 40; $r++) {
            $noB = rand(1, 2);
            for ($rBT = 1; $rBT <= $noB; $rBT++) {
                factory(App\Models\RoomBedType::class)->create([
                    'room_id' => $r
                ]);
            }
        }
        // RoomFeature
        for ($r = 1; $r <= 40; $r++) {
            $noRF = rand(1, 4);
            for ($rF = 1; $rF <= $noRF; $rF++) {
                factory(App\Models\RoomFeature::class)->create([
                    'room_id' => $r
                ]);
            }
        }

        //RoomBedType:
        // factory(App\Models\RoomBedType::class, 2)->create([]);
        //RoomFeature: 20
        // factory(App\Models\RoomFeature::class, 3)->create();

        //ServiceRoomType: 20
        // factory(App\Models\ServiceRoomType::class, 3)->create();
    }
}
