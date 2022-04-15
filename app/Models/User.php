<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'users';
    protected $primaryKey = 'username';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password_hash'
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    public function setPasswordAttribute($value) {
        $this->attributes['password_hash'] = bcrypt($value);
    }

    public function getUsername()
    {
        return $this->username;
    }

}

