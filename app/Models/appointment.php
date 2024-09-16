<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'serviceprovider_id',
        'servicename',
        'price',
        'dateofappointment',
        'mop',
        'gcashreceipt',
        'clientname',
        'address'
    ];
}
