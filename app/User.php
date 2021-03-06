<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname', 'phone_number', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function pet()
    {
        return $this->hasMany(Pet::class);
    }

    public function hasRoles(array $roles)
    {
        foreach($roles as $role)
        {
            if($this->role->name === $role)
            {
                return true;
            }
        }
    }

    public function isAdmin()
    {
        return $this->hasRoles(['admin']);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
