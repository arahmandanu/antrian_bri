<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name'];

    public function scopeByRole($query)
    {
        if (auth()->user()->hasRole('admin')) {
            return $query->where('name', '!=', 'developer');
        } else {
            return $query;
        }
    }
}
