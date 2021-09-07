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
        'program',
        'book_demo',
        'book_date',
        'session',
        'status',
        'price',
    ];
}
