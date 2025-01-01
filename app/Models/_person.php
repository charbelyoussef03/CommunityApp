<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _person extends Model
{
    use HasFactory;

    protected $table = '_person';
    
    protected $fillable = [
        'Name',
        'LastName',
        'Email',
        'PassWord',
        'DateOfBirth',
        'IsBanned',
    ];
}
