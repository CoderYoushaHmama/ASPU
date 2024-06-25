<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = [
        'created_by',
        'trip_id',
        'reservation_date',
        'passenger_email',
        'passenger_phone_number',
        'passenger_name',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }

    public function seat()
    {
        return $this->hasOne(Seat::class, 'reservation_id', 'id');
    }
}
