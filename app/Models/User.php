<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'unit_code',
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

    public function roleName()
    {
        return $this->roles->pluck('name')[0];
    }

    public function unit()
    {
        return $this->belongsTo(MstBank::class, 'unit_code', 'code');
    }

    public function scopeListByRole($query)
    {
        $excludeRole = auth()->user()->hasRole('admin');

        return $query->when($excludeRole, function ($query, $excludeRole) {
            return $query->whereHas('roles', function ($query) {
                return $query->where('name', '!=', 'developer');
            });
        });
    }
}
