<?php

namespace App\Models;

use App\Models\Instructor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->role === 'administrator';
    }

    /**
     * @return bool
     */
    public function isInstructor()
    {
        return $this->role === 'instructor' || $this->role === 'administrator';
    }

    /**
     * @return string
     */
    public function formattedRole()
    {
        return ucfirst($this->role);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function instructorProfile()
    {
        return $this->hasOne(Instructor::class, 'user_id');
    }
}
