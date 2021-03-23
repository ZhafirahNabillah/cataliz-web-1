<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['agenda_details_id', 'attachment_from_coach', 'feedback_from_coach', 'attachment_from_coachee', 'feedback_from_coach', 'rating_from_coachee', 'owner_id'];
}
