<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ['status' => 'Chưa kiểm duyệt'],
            ['status' => 'Đã kiểm duyệt'],
            ['status' => 'Huỷ bỏ']
        ];
        foreach($arr as $item){
            DB::table('status_ql')->insert($item);
        }
    }
}
