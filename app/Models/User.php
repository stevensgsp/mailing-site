<?php

namespace App\Models;

use App\Models\BaseUser as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

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
        'is_admin' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @deprecated Use the "casts" property
     *
     * @var array
     */
    protected $dates = [
        'birth_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailMessages()
    {
        return $this->hasMany(\App\Models\EmailMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }

    /**
     * Determines if the user is admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Mutator.
     *
     * @param mixed $value
     * @return void
     */
    public function setPasswordAttribute($value): void
    {
        if (is_null($value)) {
            return;
        }

        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Accessor.
     *
     * @return mixed
     */
    public function getFormattedBirthDateAttribute()
    {
        return $this->birth_date->format('Y-m-d');
    }
}
