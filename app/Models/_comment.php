<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _comment extends Model
{
    use HasFactory;
    protected $table = '_comment';
    protected $fillable = [
    
        'PostId',
        'UserId',
        'Content',
        'LikesCount',
        'IsFlagged',
        'createdAt',
    ];
    protected $attributes = [
        'LikesCount' => 0,
        'IsFlagged'=>false
    ];
    public function person()
    {
        return $this->belongsTo(_person::class, 'UserId', 'id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class,'PostId','id');
    }
    
}
