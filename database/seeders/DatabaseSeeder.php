<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Equipement;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
         
        User::factory(20)->create();
    
        Building::factory(12)->create();

        Room::factory(100)->create();
      
        Equipement::factory(20)->create();

        Reservation::factory(50)->create();
    }
}
