<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteQL extends Model
{
    use HasFactory;
    protected $table = 'note_ql';
    protected $fillable = [
        'type',
        'id_ql',
        'content_note_ql'
    ];
}
