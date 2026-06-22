<?php

use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EquipementController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Employee\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReservationsController;



Route::middleware('')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('reservations', [ReservationController::class, 'index'])->name('employee.reservations');
    Route::get('reservations/create/{room_id}', [ReservationController::class, 'reserver'])->name('employee.reservations.create');
    Route::post('reservations/store/{room_id}', [ReservationController::class, 'storeReservation'])->name('employee.reservations.store');
    Route::get('reservations/history', [ReservationController::class, 'reservationHistories'])->name('employee.reservations.history');
    Route::patch('reservations/cancelled/{reservation_id}', [ReservationController::class, 'annulerReserve'])->name('employee.reservation.cancel');

});


Route::middleware('admin')->group(function () {
    // Buildings routers 
    Route::get('admin/buildings', [BuildingController::class, 'index'])->name('admin.buildings.index');
    Route::get('admin/buildings/create', [BuildingController::class, 'create'])->name('admin.buildings.create');
    Route::get('admin/buildings/show/{id}', [BuildingController::class, 'show'])->name('admin.buildings.show');
    Route::post('admin/buildings/store', [BuildingController::class, 'store'])->name('admin.buildings.store');
    Route::patch('admin/buildings/update/{id}', [BuildingController::class, 'update'])->name('admin.buildings.update');
    Route::get('admin/buildings/edit/{id}', [BuildingController::class, 'edit'])->name('admin.buildings.edit');
    Route::delete('admin/buildings/delete/{id}', [BuildingController::class, 'destroy'])->name('buildings.destroy');

    // Equipements routers 
    Route::get('admin/equipements', [EquipementController::class, 'index'])->name('admin.equipements.index');
    Route::get('admin/equipements/create', [EquipementController::class, 'create'])->name('admin.equipements.create');
    Route::get('admin/equipements/show/{id}', [EquipementController::class, 'show'])->name('admin.equipements.show');
    Route::post('admin/equipements/store', [EquipementController::class, 'store'])->name('admin.equipements.store');
    Route::patch('admin/equipements/update/{id}', [EquipementController::class, 'update'])->name('admin.equipements.update');
    Route::get('admin/equipements/edit/{id}', [EquipementController::class, 'edit'])->name('admin.equipements.edit');
    Route::delete('admin/equipements/delete/{id}', [EquipementController::class, 'destroy'])->name('admin.equipements.destroy');

    // Rooms routers 
    Route::get('admin/rooms', [RoomController::class, 'index'])->name('admin.rooms.index');
    Route::get('admin/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
    Route::get('admin/rooms/show/{id}', [RoomController::class, 'show'])->name('admin.rooms.show');
    Route::post('admin/rooms/store', [RoomController::class, 'store'])->name('admin.rooms.store');
    Route::patch('admin/rooms/update/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
    Route::get('admin/rooms/edit/{id}', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::delete('admin/rooms/delete/{id}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');

    // Reservation   

    Route::get('admin/reservations', [ReservationsController::class, 'index'])->name('admin.reservations.index');
    Route::patch('reservations/confirmed/{id}', [ReservationsController::class, 'confirmedReservation'])->name('admin.reservations.confirm');
    Route::patch('reservations/cancelled/{id}', [ReservationsController::class, 'cancelledReservation'])->name('admin.reservations.cancel');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/rooms-of-each-building', [DashboardController::class, 'roomsOfEachBuilding']);
    Route::get('/taux-occupation', [DashboardController::class, 'tauxDoccupation']);


});


