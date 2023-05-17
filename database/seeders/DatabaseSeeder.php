<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();
        $this->call([ UsersTableSeeder::class]);

        DB::table('permissions')->truncate();
        $this->call([ PermissionsSeeder::class]);

        // DB::table('roles')->truncate();
        // $this->call([ RolesSeeder::class]);

        DB::table('hanh_lang')->truncate();
        $this->call([ HanhlangSeeder::class]);

        DB::table('khiem_khuyet')->truncate();
        $this->call([ KhiemKhuyetSeeder::class]);

        DB::table('status_nv')->truncate();
        $this->call([ StatusnvSeeder::class]);

        DB::table('status_ql')->truncate();
        $this->call([ StatusqlSeeder::class]);

        DB::table('note_nv')->truncate();
        $this->call([ NotenvSeeder::class]);

        DB::table('note_ql')->truncate();
        $this->call([ NoteqlSeeder::class]);

        DB::table('bills')->truncate();
        $this->call([ BillsSeeder::class]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
