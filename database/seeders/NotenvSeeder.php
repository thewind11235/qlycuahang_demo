<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotenvSeeder extends Seeder
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
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'hanh_lang',
                'id_nv' => 1,
                'content_note_nv' => 'hl abc test 123'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'hanh_lang',
                'id_nv' => 2,
                'content_note_nv' => 'hl 222222'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'hanh_lang',
                'id_nv' => 3,
                'content_note_nv' => 'hl 333'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'khiem_khuyet',
                'id_nv' => 1,
                'content_note_nv' => 'kk abc test 123'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'khiem_khuyet',
                'id_nv' => 4,
                'content_note_nv' => 'kk abc test 123'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'khiem_khuyet',
                'id_nv' => 4,
                'content_note_nv' => 'kk abc test 123'
            ],
        ];
        foreach($arr as $item){
            DB::table('note_nv')->insert($item);
        }
    }
}
