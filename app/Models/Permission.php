<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Permission extends Model{

    protected $fillable = ['permission_name'];

    /**
     * Get the user that owns the Permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
