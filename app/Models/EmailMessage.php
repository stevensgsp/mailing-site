<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailMessage extends BaseModel
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Determies if the email message was sent.
     *
     * @return bool
     */
    public function wasSent(): bool
    {
        return ! is_null($this->sent_at);
    }

    /**
     * Determies if the email message was created by the specified user.
     *
     * @param  \App\Models\User $user
     * @return bool
     */
    public function wasCreatedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    /**
     * Accessor.
     *
     * @return mixed
     */
    public function getStatusAttribute()
    {
        return $this->wasSent() ? 'Enviado' : 'No enviado';
    }
}
