<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _category extends Model
{
    use HasFactory;
    protected $table = '_category';
    protected $fillable = [
      'CategoryId',
    ];
    
}
