<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Session extends Model
{
    use HasFactory;

    protected $appends = ['expires_at'];

    public function getExpiredAttribute()
    {
        return $this->last_activity < Carbon::now()->subMinutes(config('session.lifetime'))->getTimestamp();
    }

    public function getExpiresAtAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity)->addMinutes(config('session.lifetime'))->toDateTimeString();
    }

    public function getIpAttribute()
    {
        return $this->ip_address;
    }

    // {{ $user->sessions->first()->expired ?? '' }}
    // {{ $user->sessions->first()->expires_at ?? '' }}
    // {{ $user->sessions->first()->ip ?? '' }}
}
