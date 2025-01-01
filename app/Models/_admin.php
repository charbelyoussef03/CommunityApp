<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _admin extends Model
{
    use HasFactory;
    protected $table = '_admin';

    protected $fillable = [
        'UserId',
        //'AccessLevel',
    ];
    
    public function person()
    {
        return $this->belongsTo(_person::class, 'UserId', 'id');
    }

}
