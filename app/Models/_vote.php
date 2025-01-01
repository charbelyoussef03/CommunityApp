<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _vote extends Model
{
    use HasFactory;
    protected $table = '_vote';
    protected $fillable = [
    'UserId',
    'CommentId',
    'PostId',
    'IsUpvote',
    ];
    public function comment()
    {
        return $this->belongsTo(_comment::class,'CommentId','id');
    }
    public function person()
    {
        return $this->belongsTo(_person::class,'UserId','id');
    }
    public function post()
    {
        return $this->belongsTo(_post::class,'PostId','id');
    }
}
