<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';
    protected $fillable = [
        'created_by',
        'food_id',
        'p_type_id',
        'bus_name',
        'departure',
        'destination',
        'departure_date',
        'number_of_seats',
        'fare',
    ];

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function food(){
        return $this->belongsTo(Food::class,'food_id','id');
    }

    public function payType(){
        return $this->belongsTo(PayType::class,'p_type_id','id');
    }
}