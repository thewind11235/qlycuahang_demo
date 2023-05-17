<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XuatTuyen extends Model
{
    use HasFactory;
    protected $table = 'xuat_tuyen_tag';
    protected $fillable = [
        'name',
        'description'
    ];
    public $timestamps = false;
}
