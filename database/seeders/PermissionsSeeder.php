<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ['permission_name' => 'Administrator', 'slug' => 'admin'],
            ['permission_name' => 'Kỹ thuật', 'slug' => 'tech_mod'],
            ['permission_name' => 'Trực ban', 'slug' => 'onduty_mod'],
            ['permission_name' => 'Nhân viên', 'slug' => 'user']
        ];
        foreach($arr as $item){
            DB::table('permissions')->insert($item);
        }
    }
}
