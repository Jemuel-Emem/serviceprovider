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
    ];
}
