<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
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
    ];

    public function programs()
    {
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    }
}
