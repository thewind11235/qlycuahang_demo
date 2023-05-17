<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'id' => 1,
                'staff_id' => 1,
                'name_device' => 'Laptop Gaming Type 1',
                'status_device' => 'Vỏ nguyên vẹn, hỏng RAM',
                'description' => "Laptop cần thay RAM và vệ sinh",
                'accessory_ids' => '1,2,3',
                'price' => '500000',
                'estimate_time' => '1 ngày',
                'status_bill' => 'Chưa thanh toán',
                'created_at' => '2023-05-16 15:53:44',
                'updated_at' => '2023-05-16 15:53:44',
            ],
            [
                'id' => 2,
                'staff_id' => 2,
                'name_device' => 'Laptop Gaming Type 2',
                'status_device' => 'Vỏ nguyên vẹn, hỏng RAM',
                'description' => "Laptop cần thay RAM và vệ sinh",
                'accessory_ids' => '1,2,3',
                'price' => '500000',
                'estimate_time' => '1 ngày',
                'status_bill' => 'Chưa thanh toán',
                'created_at' => '2023-05-16 15:53:44',
                'updated_at' => '2023-05-16 15:53:44',
            ],
            [
                'id' => 3,
                'staff_id' => 3,
                'name_device' => 'Laptop Gaming Type 3',
                'status_device' => 'Vỏ nguyên vẹn, hỏng RAM',
                'description' => "Laptop cần thay RAM và vệ sinh",
                'accessory_ids' => '1,2,3',
                'price' => '500000',
                'estimate_time' => '1 ngày',
                'status_bill' => 'Chưa thanh toán',
                'created_at' => '2023-05-16 15:53:44',
                'updated_at' => '2023-05-16 15:53:44',
            ],
        ];
        foreach($arr as $item){
            DB::table('bills')->insert($item);
        }
    }
}
