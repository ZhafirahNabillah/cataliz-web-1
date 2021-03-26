<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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
        if (count($words) > 1) {
            return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        } else {
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

    // protected $appends = ['profil_picture_url', 'background_picture_url'];

    // public function getAvatarUrlAttribute($value)
    // {
    //     $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/images/profil_picture/';
    //     return $url . $this->profil_picture;
    // }

    // public function getBackgroundUrlAttribute($value)
    // {
    //     $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/images/background_picture/';
    //     return $url . $this->background_picture;
    // }
}
