<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $keyType = 'string';
    
    public function user_teams()
    {
        return $this->hasMany(UserTeam::class, 'team_id');
    }
}
