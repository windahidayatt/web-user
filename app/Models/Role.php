<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $keyType = 'string';

    public function students()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
