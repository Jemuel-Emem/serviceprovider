<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_name',
        'phone_number',
        'address',
        'description',
        'price',
        'photo_path',
        'gcashname',
        'gcashnumber',
        'status',
        'availability'
    ];


public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
