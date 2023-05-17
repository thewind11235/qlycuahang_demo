<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;


class KhiemKhuyetSeeder extends Seeder
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
                'id_nv' => 4,
                'id_nvw' => 4,
                'create_time' => now(),
                'update_time_nv' => now(),
                'update_time_ql' => now(),
                'id_status_nv' => 1,
                'id_status_ql' => 1,
                'id_note_nv' => 4,
                'id_note_ql' => 4,
                'xuat_tuyen' => 'A123',
                'tu_tru_den_tru' => 'A12->A15',
                'loai_khiem_khuyet' => 'Đường dây',
                'noi_dung_khiem_khuyet' => '',
                'vat_tu' => 'kìm, dây điện',
                'bien_phap_at' => 'thang gỗ',
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
                'id_nvw' => 2,
                'create_time' => now(),
                'update_time_nv' => now(),
                'update_time_ql' => now(),
                'id_status_nv' => 2,
                'id_status_ql' => 2,
                'id_note_nv' => 5,
                'id_note_ql' => 5,
                'xuat_tuyen' => 'A123',
                'tu_tru_den_tru' => 'A12->A15',
                'loai_khiem_khuyet' => 'Trạm biến áp',
                'noi_dung_khiem_khuyet' => '',
                'vat_tu' => 'búa, kìm',
                'bien_phap_at' => 'đai bảo vệ',
                'de_xuat' => 'xử lí',
                'muc_do' => 'nguy hiểm',
                'toa_do_nv' => '11.5534139,106.2409119',
                'toa_do_nvw' => '11.5534139,106.2409119',
                'device_info' => 'version: Instance of \'AndroidBuildVersion\' \nboard: blueline \nbootloader: b1c1-0.4-7617406 \nbrand: google \ndevice: google',
                'images' => '',
                'images_nvw' => '',
            ],
            [
                'id_nv' => 3,
                'id_nvw' => 2,
                'create_time' => now(),
                'update_time_nv' => now(),
                'update_time_ql' => now(),
                'id_status_nv' => 3,
                'id_status_ql' => 3,
                'id_note_nv' => 6,
                'id_note_ql' => 6,
                'xuat_tuyen' => 'A123',
                'tu_tru_den_tru' => 'A12->A15',
                'loai_khiem_khuyet' => 'Trụ',
                'noi_dung_khiem_khuyet' => '',
                'vat_tu' => 'kìm, dây điện',
                'bien_phap_at' => 'thang gỗ',
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
            DB::table('khiem_khuyet')->insert($item);
        }
    }
}
