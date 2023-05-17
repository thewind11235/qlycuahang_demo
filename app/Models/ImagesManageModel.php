<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesManageModel extends Model
{
    use HasFactory;
    protected $table = 'images_manager';
    protected $fillable = [
        'id_task',
        'type_task',
        'id_user',
        'image_link',
    ];
    public $timestamps = false;

}
