<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteNV extends Model
{
    use HasFactory;
    protected $table = 'note_nv';
    protected $fillable = [
        'type',
        'id_nv',
        'content_note_nv'
    ];
}
