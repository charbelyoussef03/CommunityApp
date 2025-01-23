<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class _person extends Model
{
    use HasFactory , HasApiTokens;

    protected $table = '_person';
    
    protected $fillable = [
        'Name',
        'LastName',
        'Email',
        'PassWord',
        'DateOfBirth',
        'IsBanned',
    ];
    protected $attributes = [
        'IsBanned' => false,
    ];
    public function posts()
    {
        return $this->hasMany(Post::class,'AuthorId','id');
    }
}
