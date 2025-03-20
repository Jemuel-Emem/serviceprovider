<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'phonenumber',
        'email',
        'password',
        'role',
        'gcashname',
        'gcashnumber',
        'id_photo'
    ];
    public function services()
    {
        return $this->hasMany(services::class, 'user_id');
    }
    public function appointments()
    {
        return $this->hasMany(appointment::class, 'serviceprovider_id');
    }
    public function receivedAppointments()
    {
        return $this->hasMany(Appointment::class, 'serviceprovider_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'client_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'serviceprovider_id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
