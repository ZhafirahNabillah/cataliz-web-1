<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'program_id'
    ];

    public function programs()
    {
        return $this->belongsTo('App\Models\program_lms', 'program_id', 'id');
    }
}
