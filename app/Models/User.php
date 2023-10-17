<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Auth;

// use HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }


    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function userID()
    {
        return $this->user_id;
    }

    public function getRole($role)
    {
        $getRole = User::join('model_has_roles','model_has_roles.model_id','=','users.id')
                    ->join('roles','roles.id','=','model_has_roles.role_id')
                    ->where('roles.name', $role)
                    ->where('model_has_roles.model_id', Auth::user()->id)
                    ->select('roles.name')
                    ->groupBy('roles.name')
                    ->first();

        if (empty($getRole)) {
            return false;
        } else {
            return true;
        }
    }

    public function getManyRole($roles)
    {
        $getRoles = User::join('model_has_roles','model_has_roles.model_id','=','users.id')
                    ->join('roles','roles.id','=','model_has_roles.role_id')
                    ->whereIn('roles.name', $roles)
                    ->where('model_has_roles.model_id', Auth::user()->id)
                    ->select('users.name')
                    ->first();

        // print_r($getRoles);
        // die();
        if (empty($getRoles->name)) {
            return false;
        } else {
            return true;
        }
    }

    public function getPermission($permission)
    {
        $getPermission = User::join('model_has_roles','model_has_roles.model_id','=','users.id')
                    ->join('role_has_permissions','role_has_permissions.role_id','=','model_has_roles.role_id')
                    ->join('permissions','permissions.id','=','role_has_permissions.permission_id')
                    ->where('permissions.name', $permission)
                    ->where('model_has_roles.model_id', Auth::user()->id)
                    ->select('users.name')
                    ->first();

        // print_r($getPermission->name);
        // die();
        if (empty($getPermission->name)) {
            return false;
        } else {
            return true;
        }
    }

    public function getManyPermission($permissions)
    {
        $getPermissions = User::join('model_has_roles','model_has_roles.model_id','=','users.id')
                    ->join('role_has_permissions','role_has_permissions.role_id','=','model_has_roles.role_id')
                    ->join('permissions','permissions.id','=','role_has_permissions.permission_id')
                    ->whereIn('permissions.name', $permissions)
                    ->where('model_has_roles.model_id', Auth::user()->id)
                    ->select('users.name')
                    ->first();

        // print_r($getPermission->name);
        // die();
        if (empty($getPermissions->name)) {
            return false;
        } else {
            return true;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }

    // public function hasRole($role)
    // {
    //     // return User::where('roles', $role)->get();
    //     // print_r($role);
    //     // die();
    //     return User::where('roles', $role)->get();
    // }
}
