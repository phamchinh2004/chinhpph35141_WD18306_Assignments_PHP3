<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    const ROLE_ADMIN = "admin";
    const ROLE_MEMBER = "member";
    const ROLE_STAFF = "staff";


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'email_verified_at',
        'password',
        'role',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail($this->email, $this->fullname, 'Cảm ơn bạn đã đăng ký tài khoản!'));
    }
    public function informations()
    {
        return $this->hasMany(Information::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
