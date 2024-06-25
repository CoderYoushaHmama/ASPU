<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = [
        'created_by',
        'trip_id',
        'name',
        'description',
    ];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function trip(){
        return $this->belongsTo(Trip::class,'trip_id','id');
    }
}