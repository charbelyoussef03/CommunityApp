<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _report extends Model
{
    use HasFactory;
    protected $table = '_report';
    protected $fillable = [
     'ReporterId',
     'ReportedId',
     'Reason',
     'Status',
    ];
    public function person_reported()
    {
        return $this->belongsTo(_person::class,'ReportedId','id');
    }
    public function person_reporter()
    {
        return this->belongsTo(_person::class,'ReporterId','id');
    }
}
