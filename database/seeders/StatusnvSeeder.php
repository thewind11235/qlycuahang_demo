<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusnvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ['status' => 'Chờ duyệt'],
            ['status' => 'Đang xử lí'],
            ['status' => 'Hoàn thành']
        ];
        foreach($arr as $item){
            DB::table('status_nv')->insert($item);
        }
    }
}
