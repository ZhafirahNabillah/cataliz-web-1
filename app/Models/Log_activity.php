<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_activity extends Model
{
    protected $fillable = ['log_name','description','subject_type','subject_id','causer_type','causer_id','properties'];
}
