<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'phone'
    ];

    public function getPhoneNumberAttribute()
    {
        return rtrim(chunk_split($this->phone, 3, '-'), '-');
    }
}
