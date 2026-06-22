<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'floors_count',
        'is_active',
    ];

    public function rooms(){
        return $this->hasMany(Room::class);

    }
    
}
