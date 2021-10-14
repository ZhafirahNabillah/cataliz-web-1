<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, LogsActivity;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'reset_code',
        'verification_code',
        'is_verified'
    ];

    //Log activity
    protected static $logAttributes = [
        'name',
        'phone',
        'email',
        'reset_code',
        'verification_code',
        'is_verified'
    ];

    protected static $logName = 'Users';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Users";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    // protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function initials()
    {
        $words = explode(" ", $this->name);
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }
        if (count($words) > 2) {
            return strtoupper(substr($words[0], 0, 1). substr($words[1], 0, 1). substr(end($words), 0, 1));
        }elseif (count($words) > 1) {
            return strtoupper(substr($words[0], 0, 1). substr(end($words), 0, 1));
        }else {
            return strtoupper(substr($words[0], 0, 1));
        }
    }

    public function client()
    {
        return $this->hasOne('App\Models\Client');
    }

    public function coach()
    {
        return $this->hasOne('App\Models\Coach');
    }

    public function topic()
    {
        return $this->hasMany('App\Models\Topic', 'trainer_id');
    }

    public function Exams()
    {
        return $this->hasMany('App\Models\Exam_result', 'user_id');
    }

    public function training_feedbacks()
    {
        return $this->hasMany('App\Models\Training_feedback', 'owner_id');
    }
}
