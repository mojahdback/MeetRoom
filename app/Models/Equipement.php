<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description'
    ];

     public function rooms()
    {
        return $this->belongsToMany(
            Room::class,
            'equipement_room',
            'equipement_id',
            'room_id'
        );
    }
}
