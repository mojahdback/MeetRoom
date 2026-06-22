<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'floor',
        'is_active',
        'building_id'
    ];

    public function building(){
        return $this->belongsTo(Building::class);
    }

    public function equipements(){
        return $this->belongsToMany(
            Equipement::class,
            'equipement_room',
            'room_id',
            'equipement_id'
        );
    }

     public function reservations(){
        return $this->hasMany(Reservation::class);

    }

    
}
