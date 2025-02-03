<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = '_post';
    protected $fillable = [
        'Title',
        'Category',
        'Content',
        'PictureUrl',
        'ViewsCount',
        'LikesCount',
        'IsFlagged',
        'IsApproved',
        'AuthorId'
    ];

    protected $attributes = [
        'ViewsCount' => 0,       // Default ViewsCount
        'LikesCount' => 0,       // Default LikesCount
        'IsFlagged' => false,    // Default IsFlagged
        'IsApproved' => false,   // Default IsApproved
          
    ];
   
    public function person()
    {
        return $this->belongsTo(_person::class, 'AuthorId', 'id');
    }
    public function comments()
    {
        return $this->hasmany(_comment::class,'PostId','id')->with('person');
    }
    public function vote()
    {
        return $this->hasmany(_vote::class,'id','PostId');
    }
}
