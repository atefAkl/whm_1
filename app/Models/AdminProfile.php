<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;

    protected $table = 'admin_profiles';
    protected $fillable = [
        'id',
        'admin_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'picture',
        'created_at',
        'updated_at'
    ];
}
