<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'serviceprovider_id', 'message', 'from_client'];


    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function serviceProvider()
    {
        return $this->belongsTo(User::class, 'serviceprovider_id');
    }
}
