<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $table = 'licenses';

    protected $fillable = [
        'name',
        'file',
        'files',
        'start_date',
        'end_date',
        'phone'
    ];

    public function getPhoneNumberAttribute()
    {
        return rtrim(chunk_split($this->phone, 3, '-'), '-');
    }
}
