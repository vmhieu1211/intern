<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['name', 'description', 'email', 'tel', 'address', 'logo', 'favicon'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
