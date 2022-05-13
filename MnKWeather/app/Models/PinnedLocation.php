<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class PinnedLocation extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'PinnedLocation';
    protected $primaryKey = ['id','username'];
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'username'
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function get($username,$id)
    {
        return DB::table("PinnedLocation")->where('username',$username)->where("id",$id)->first();
    }
    public function getAll($username)
    {
        return DB::table("PinnedLocation")->where('username',$username)->first();
    }

}
