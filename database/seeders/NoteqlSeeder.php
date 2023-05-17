<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteqlSeeder extends Seeder
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
                'id_ql' => 1,
                'content_note_ql' => 'hl ql abc 123'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'hanh_lang',
                'id_ql' => 2,
                'content_note_ql' => 'hl 222222'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'hanh_lang',
                'id_ql' => 3,
                'content_note_ql' => 'hl 333'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'khiem_khuyet',
                'id_ql' => 2,
                'content_note_ql' => 'kk ql abc 123'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'khiem_khuyet',
                'id_ql' => 3,
                'content_note_ql' => 'kk ql abc 123'
            ],
            [
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'type'  => 'khiem_khuyet',
                'id_ql' => 1,
                'content_note_ql' => 'kk ql abc 123'
            ],
        ];
        foreach($arr as $item){
            DB::table('note_ql')->insert($item);
        }
    }
}
