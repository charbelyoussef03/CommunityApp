<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = '_post';
    protected $fillable = [
        'AuthorId',
        'Title',
        'ViewsCount',
        'LikesCount',
        'Category',
        'IsFlagged',
        'IsApproved',
        'Content',
        'PictureUrl',
    ];

    public function person()
    {
        return $this->belongsTo(_person::class, 'AuthorId', 'id');
    }
    public function comment()
    {
        return $this->hasmany(_comment::class,'id','PostId');
    }
    public function vote()
    {
        return $this->hasmany(_vote::class,'id','PostId');
    }
}
