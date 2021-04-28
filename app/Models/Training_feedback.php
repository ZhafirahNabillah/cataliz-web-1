<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'description',
        'owner_id',
        'from',
        'to'
    ];

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam_result');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User');
    }
}
