<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInstall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'role',
        'status',
        'user_ip',
        'user_agent',
    ];
}
