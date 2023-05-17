<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class HanhlangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id_nv' => 3,
                'id_nvw' => 4,
                'create_time' => now(),
                'update_time_nv' => now(),
                'update_time_ql' => now(),
                'id_status_nv' => 1,
                'id_status_ql' => 1,
                'id_note_nv' => 1,
                'id_note_ql' => 1,
                'xuat_tuyen' => 'A123',
                'tu_tru_den_tru' => 'A12->A15',
                'so_cay' => 3,
                'khoang_cach' => '10m',
                'pa_phat_quang' => 'Không cắt điện',
                'de_xuat' => 'xử lí',
                'muc_do' => 'nguy hiểm',
                'toa_do_nv' => '11.5534139,106.2409119',
                'toa_do_nvw' => '11.5534139,106.2409119',
                'device_info' => 'version: Instance of \'AndroidBuildVersion\' \nboard: blueline \nbootloader: b1c1-0.4-7617406 \nbrand: google \ndevice: google',
                'images' => '',
                'images_nvw' => '',
            ],
            [
                'id_nv' => 4,
                'id_nvw' => 3,
                'create_time' => now(),
                'update_time_nv' => now(),
                'update_time_ql' => now(),
                'id_status_nv' => 2,
                'id_status_ql' => 2,
                'id_note_nv' => 2,
                'id_note_ql' => 2,
                'xuat_tuyen' => 'A123',
                'tu_tru_den_tru' => 'A12->A15',
                'so_cay' => 3,
                'khoang_cach' => '10m',
                'pa_phat_quang' => 'Cắt điện',
                'de_xuat' => 'xử lí',
                'muc_do' => 'nguy hiểm',
                'toa_do_nv' => '11.5534139,106.2409119',
                'toa_do_nvw' => '11.5534139,106.2409119',
                'device_info' => 'version: Instance of \'AndroidBuildVersion\' \nboard: blueline \nbootloader: b1c1-0.4-7617406 \nbrand: google \ndevice: google',
                'images' => '',
                'images_nvw' => '',
            ],
            [
                'id_nv' => 2,
                'id_nvw' => 2,
                'create_time' => now(),
                'update_time_nv' => now(),
                'update_time_ql' => now(),
                'id_status_nv' => 3,
                'id_status_ql' => 3,
                'id_note_nv' => 3,
                'id_note_ql' => 3,
                'xuat_tuyen' => 'A123',
                'tu_tru_den_tru' => 'A12->A15',
                'so_cay' => 3,
                'khoang_cach' => '10m',
                'pa_phat_quang' => 'Không cắt điện',
                'de_xuat' => 'xử lí',
                'muc_do' => 'bình thường',
                'toa_do_nv' => '11.5534139,106.2409119',
                'toa_do_nvw' => '11.5534139,106.2409119',
                'device_info' => 'version: Instance of \'AndroidBuildVersion\' \nboard: blueline \nbootloader: b1c1-0.4-7617406 \nbrand: google \ndevice: google',
                'images' => '',
                'images_nvw' => '',
            ]
        ];
        foreach($data as $item){
            DB::table('hanh_lang')->insert($item);
        }
    }
}
