<?php

namespace App\Models;

use App\Mail\ResetPasswordMail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'photo_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $url = "http://localhost:4200/user/reset-password?token=" . $token;
        Mail::to($this->email)->send(new ResetPasswordMail(['url' => $url]));
    }

    public function addedTargetLocations()
    {
        return $this->hasMany(AddedTargetLocation::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function human_readable_date()
    { //dddd Do of MMMM YYYY h:mm:ss A
        return Carbon::parse($this->attributes['created_at'])->isoFormat("Do of MMMM YYYY");
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
