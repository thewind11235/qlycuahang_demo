<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HanhLangModel extends Model
{
    use HasFactory;

    protected $table = 'hanh_lang';
    protected $fillable = [
        'id_nv',
        'id_nvw',
        'id_status_nv',
        'id_status_ql',
        'id_note_nv',
        'id_note_ql',
        'toa_do_nv',
        'toa_do_nvw',
        'xuat_tuyen',
        'tu_tru_den_tru',
        'so_cay',
        'khoang_cach',
        'pa_phat_quang',
        'phuong_an',
        'muc_do',
        'device_info',
        'images',
    ];
    public $timestamps = false;

    public static function boot() {
        parent::boot();

        static::deleting(function($hanhlang) {
            $hanhlang->noteNv()->delete();
            $hanhlang->noteQl()->delete();
        });
    }
    public function noteNv()
    {
        return $this->belongsTo('App\Models\NoteNV', 'id_note_nv', 'id');
    }
    public function noteQl()
    {
        return $this->belongsTo('App\Models\NoteQL', 'id_note_ql', 'id');
    }
}
