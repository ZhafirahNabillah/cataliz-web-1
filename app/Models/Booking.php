<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'name',
        'email',
        'whatsapp_number',
        'instance',
        'profession',
        'address',
        'goals',
        'book_demo',
        'book_date',
        'session_coaching',
        'session_training',
        'session_mentoring',
        'status',
        'price',
        'program_id',
        'batch_id',
        'bank',
        'payment',
        'link',
    ];

    public function setBookDemoAttribute($value)
    {
        $this->attributes['book_demo'] = json_encode($value);
    }

    public function getBookDemoAttribute($value)
    {
        return $this->attributes['book_demo'] = json_decode($value);
    }

    public function programs()
    {
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    }
    public function batchs()
    {
        return $this->belongsTo('App\Models\Batch', 'batch_id', 'id');
    }
}
