<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ['name'];

    public function Users() :HasOne
    {
        return $this->hasOne(User::class);
    }
}
