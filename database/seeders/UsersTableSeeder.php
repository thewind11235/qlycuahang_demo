<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@abc.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
                'msnv' => 123,
                'permission_id' => 1,
                'chuc_danh' => 'vận hành viên',
                'bac_tho'   => '2/7',
                'bac_an_toan'=> '3/5',
                'status' => 1
            ],
            [
                'name' => 'Thu ngân',
                'email' => 'cashier@abc.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
                'msnv' => 111,
                'permission_id' => 2,
                'chuc_danh' => 'vận hành viên',
                'bac_tho'   => '2/7',
                'bac_an_toan'=> '3/5',
                'status' => 1
            ],
            [
                'name' => 'Nhân viên',
                'email' => 'staff@abc.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
                'msnv' => 222,
                'permission_id' => 4,
                'chuc_danh' => 'vận hành viên',
                'bac_tho'   => '2/7',
                'bac_an_toan'=> '3/5',
                'status' => 1
            ],
            [
                'name' => 'Nhân viên',
                'email' => 'user@abc.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
                'msnv' => 333,
                'permission_id' => 4,
                'chuc_danh' => 'vận hành viên',
                'bac_tho'   => '2/7',
                'bac_an_toan'=> '3/5',
                'status' => 1
            ]
        ];
        foreach($users as $user){
            DB::table('users')->insert($user);
        }
    }
}
