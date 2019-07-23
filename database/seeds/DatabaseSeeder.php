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

        //có thể thay đổi
        static $userNum = 25, $mnNum = 5, $adNum = 3, $hotelNum = 15, $questionNum = 40;

        //không thể thay đổi
        static $hotelType = 7, $roomMode = 4,  $roomType= 4, $bedType = 5, $roomService = 5, $feature = 8, $bookingStatus = 5, $paymentMethod = 2;

        //Dữ liệu
        static $userAddress = ['Long An','Hà Nội','Hồ Chí Minh','Quãng Ngải','Đà Nẵng','Cà Mau','Hải Phòng'];

        //User:
        factory(App\Models\User::class, $userNum)->create();

        //Hotel manager:
        for ($m = 1; $m <= $mnNum; $m++) {
            DB::table('hotel_manager')->insert([
                'user_id' => $m,
            ]);
        }
        //Customer: 23
        for ($cus = $mnNum + 1; $cus <= $userNum; $cus++) {
            DB::table('customer')->insert([
                'user_id' => $cus,
                'coin' => rand(100, 100000),
                'address' => $userAddress[rand(0,6)],
            ]);
        }

        //Admin:1 
        factory(App\Models\Admin::class, $adNum)->create();

        //Hotel type: 7
        DB::table('hotel_type')->insert([
            'id' => 1,
            'name' => 'Bình Dân',
            'meta_name' => 'business-hotel',
        ]);
        DB::table('hotel_type')->insert([
            'id' => 2,
            'name' => 'Khách Sạn Nghỉ Dưỡng',
            'meta_name' => 'resort-hotel',
        ]);
        DB::table('hotel_type')->insert([
            'id' => 3,
            'name' => 'Homestay',
            'meta_name' => 'homestay',
        ]);
        DB::table('hotel_type')->insert([
            'id' => 4,
            'name' => 'Khách Sạn Sân Bay',
            'meta_name' => 'airport-hotel',
        ]);
        DB::table('hotel_type')->insert([
            'id' => 5,
            'name' => 'Khách Sạn Thu Nhỏ',
            'meta_name' => 'mini-hotel',
        ]);
        DB::table('hotel_type')->insert([
            'id' => 6,
            'name' => 'Spa Hotel',
            'meta_name' => 'spa-hotel',
        ]);
        DB::table('hotel_type')->insert([
            'id' => 7,
            'name' => 'Căn Hộ Dịch Vụ',
            'meta_name' => 'serviced-apartment',
        ]);

        //User image:
        for ($j = 1; $j <= $userNum; $j++) {
            $img = rand(1,25);
            DB::table('user_image')->insert([
                'image_link' => $img.'.png',
                'name' => 'dog2',
                'is_primary' => 1,
                'user_id' => $j
            ]);
        }

        //Room Mode: 4
        DB::table('room_mode')->insert([
            'name' => 'Du Lịch Một Mình',
            'status' => 1,
        ]);
        DB::table('room_mode')->insert([
            'name' => 'Dành Cho Cặp Đôi',
            'status' => 1,
        ]);
        DB::table('room_mode')->insert([
            'name' => 'Dành Cho Gia Đình',
            'status' => 1,
        ]);
        DB::table('room_mode')->insert([
            'name' => 'Dành Cho Tập Thể',
            'status' => 1,
        ]);

        //Room type: 4
        DB::table('room_type')->insert([
            'name' => 'Tiêu Chuẩn',
            'description' => 'Standard',
            'status' => 1,
        ]);
        DB::table('room_type')->insert([
            'name' => 'Hạng Trung',
            'description' => 'Superior',
            'status' => 1,
        ]);
        DB::table('room_type')->insert([
            'name' => 'Cao Cấp',
            'description' => 'Deluxe',
            'status' => 1,
        ]);
        DB::table('room_type')->insert([
            'name' => 'Hạng Sang',
            'description' => 'Suite',
            'status' => 1,
        ]);
        // DB::table('room_type')->insert([
        //     'name' => 'Economy ',
        //     'description' => 'economy ',
        //     'status' => 1,
        // ]);
        // DB::table('room_type')->insert([
        //     'name' => 'Business',
        //     'description' => 'business  ',
        //     'status' => 1,
        // ]);

        //Bed Type: 5
        DB::table('bed_type')->insert([
            'name' => 'Giường Đơn',
            'width' => '120',
            'length' => '190',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'Giường Đôi',
            'width' => '150',
            'length' => '190',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'Queen Bed',
            'width' => '160',
            'length' => '200',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'King Bed',
            'width' => '180',
            'length' => '200',
            'status' => 1,
        ]);
        DB::table('bed_type')->insert([
            'name' => 'Bunk Bed',
            'width' => '120',
            'length' => '190',
            'status' => 1,
        ]);

        //Room services: 5
        DB::table('service')->insert([
            'name' => 'Wi-Fi Miễn Phí',
            'meta_name' => 'free-wifi',
            'icon' => 'wifi',
            'status' => true,
        ]);
        DB::table('service')->insert([
            'name' => 'Bữa Sáng Miễn Phí',
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
            'name' => 'Giặc Ủi',
            'meta_name' => 'laundry',
            'icon' => 'caret-square-down',
            'status' => true,
        ]);
        DB::table('service')->insert([
            'name' => 'Lễ Tân Phục Vụ 24/24',
            'meta_name' => 'front-desk',
            'icon' => 'concierge-bell',
            'status' => true,
        ]);

        //Feature: 8
        DB::table('feature')->insert([
            'name' => 'Tivi',
            'meta_name' => 'tv',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Điều Hòa',
            'meta_name' => 'ac',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Có Két Sắt',
            'meta_name' => 'safety-box',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Máy Sấy Tóc',
            'meta_name' => 'hair-dryer',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Radio',
            'meta_name' => 'radio',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Ban Công',
            'meta_name' => 'balcony',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Tủ Lạnh',
            'meta_name' => 'refrigerator',
            'status' => true,
        ]);
        DB::table('feature')->insert([
            'name' => 'Bàn Học/Làm Việc',
            'meta_name' => 'writing-desks',
            'status' => true,
        ]);

        // //Coupon code
        // factory(App\Models\CouponCode::class, $couponCode)->create();

        //Hotel: 15
        //length 16
        $arr = [1,3,16,28,29,32,33,35,40,87,98,106,109];
        for($i = 1;$i<=$hotelNum;$i++){
            $rand = rand(0,sizeOf($arr)-1);
            factory(App\Models\Hotel::class)->create([
                'ward_id' => $arr[$rand],
                'address' => 'Hà Nội',
            ]);
            $cancel = rand (0,7);
            if($cancel ==0) $refund = 0;
            else $refund = rand(0,15);
            $content = '';
            $check_in = '08:00';
            $check_out = '17:00';
            switch($cancel){
                case 0:
                    $content = $content.'Sau khi yêu cầu đặt phòng được chấp nhận, bạn không thể hủy đơn đặt phòng. ';
                    break;
                default:
                    if($refund == 0){
                        $content = $content.'Sau khi yêu cầu đặt phòng được chấp nhận, bạn có thể hủy đơn đặt phòng trước ngày Check-In '.$cancel.' ngày. Tuy nhiên, bạn sẽ không được hoàn trả phía đã thanh toán.';
                    }else{
                        $content = $content.'Sau khi yêu cầu đặt phòng được chấp nhận, bạn có thể hủy đơn đặt phòng trước ngày Check-In '.$cancel.' ngày. Chúng tôi chấp nhận hoàn trả '.$refund.'% các chi phí mà bạn đã thanh toán.';
                    }
                break;
            }
            factory(App\Models\Policy::class)->create([
                'hotel_id' => $i,
                'check_in' => $check_in.':00',
                'check_out' => $check_out.':00',
                'cancelable' => $cancel,
                'can_refund' => $refund,
                'content' => $content
            ]);

        }       

        static $count = 0, $countCoup = 0;
        for ($h = 1; $h <= $hotelNum; $h++) {
            $couNo = rand(1, 5);
            $countCoup += $couNo;
            $rTNum = rand(2, 4);
            for ($rT = 1; $rT <= $rTNum; $rT++) {
                //Room
                $rNum = rand(2, $roomMode);
                $count += $rNum;
                factory(App\Models\Room::class, $rNum)->create([
                    'hotel_id' => $h,
                    'room_type_id' => $rT
                ]);

                //ServiceRoomType
                $noS = rand(3, $roomService);
                for ($s = 1; $s <= $noS; $s++) {
                    factory(App\Models\ServiceRoomType::class)->create([
                        'room_type_id' => $rT,
                        'hotel_id' => $h
                    ]);
                }
            }
            //CouponCode
            for ($c = ($countCoup - $couNo + 1); $c <= $countCoup; $c++) {
                factory(App\Models\CouponCode::class)->create([
                    'hotel_id' => $h,
                ]);
                $apRT = rand(1, $rTNum);
                for ($a = 1; $a <= $apRT; $a++) {
                    factory(App\Models\ApplyCouponCodeRoomType::class)->create([
                        'coupon_code_id' => $c,
                        'room_type_id' => $a
                    ]);
                }
            }
        }
        static $img = 0;
        for ($r = 1; $r <= $count; $r++) {
            //RoomImage
            if($img == 50) $img =0;
            $img++;
            factory(App\Models\RoomImage::class)->create([
                'room_id' => $r,
                'image_link' => $img.'.png',
            ]); 
            for($i=0;$i<4;$i++){
                $rI = rand($img+1,50);
                factory(App\Models\RoomImage::class)->create([
                    'room_id' => $r,
                    'image_link' => $rI.'.png',
                    'is_primary' => 0,
                ]); 
            }
            //RoomFeature
            $noRF = rand(2, $feature);
            for ($rF = 1; $rF <= $noRF; $rF++) {
                factory(App\Models\RoomFeature::class)->create([
                    'room_id' => $r
                ]); 
            }
            //RoomBedType
            $noB = rand(1, 2);
            for ($rB = 1; $rB <= $noB; $rB++) {
                factory(App\Models\RoomBedType::class)->create([
                    'room_id' => $r
                ]);
            }
        }

        //Booking status
        factory(App\Models\BookingStatus::class)->create([]);
        factory(App\Models\BookingStatus::class)->create([
            'name' => 'Chờ Thanh Toán'
        ]);
        factory(App\Models\BookingStatus::class)->create([
            'name' => 'Bị Từ Chối'
        ]);
        factory(App\Models\BookingStatus::class)->create([
            'name' => 'Hoàn Thành'
        ]);
        factory(App\Models\BookingStatus::class)->create([
            'name' => 'Khách Đã Hủy'
        ]);
        factory(App\Models\BookingStatus::class)->create([
            'name' => 'Nhà Cung Cấp Đã Hủy'
        ]);
        factory(App\Models\BookingStatus::class)->create([
            'name' => 'Quá Hạn'
        ]);

        //Booking method
        factory(App\Models\PaymentMethod::class)->create([]);
        factory(App\Models\PaymentMethod::class)->create([
            'name' => 'Chuyển Khoản Online'
        ]);

        for ($uID = $mnNum + 1; $uID <= 10; $uID++) {
            //Booking
            $bNo = rand(5, 10);
            for ($b = 1; $b <= $bNo; $b++) {
                $m = rand(1, 8);
                $d = rand(10, 25);
                if($m == 2 && $d>=23) $d = 20;
                factory(App\Models\Booking::class)->create([
                    'customer_id' => $uID,
                    'check_in' => '2019-0' . $m . '-' . $d,
                    'check_out' => '2019-0' . $m . '-' . ($d + 5),
                    'room_id' => rand(1, $count),
                ]);
            }
            //HotelFollowing
            for ($f = 1; $f <= rand(2, 5); $f++) {
                factory(App\Models\HotelFollowing::class)->create([
                    'customer_id' => $uID,
                    'hotel_id' => $f,
                ]);
            }

            //CustomerFollowing
            for ($cF = 11; $cF <= rand(11, 25); $cF++) {
                factory(App\Models\CustomerFollowing::class)->create([
                    'follower_id' => $uID,
                    'followed_id' => $cF,
                ]);
            }
        }

        factory(App\Models\HotelImage::class, $hotelNum)->create([]);
        factory(App\Models\Question::class, $questionNum)->create([]);
        for($i =1;$i<=$hotelNum;$i++){
            for($j=1;$j<=4;$j++){
                $img = rand(1,30);
                factory(App\Models\HotelImage::class)->create([
                    'hotel_id' => $i,
                    'is_primary' => 0,
                    'image_link' => $img.'.png',
                ]);
            }
        }
    }
}
