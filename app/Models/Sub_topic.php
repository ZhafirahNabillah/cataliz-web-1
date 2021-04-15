<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_topic',
        'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }
}
