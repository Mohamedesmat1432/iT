<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatchBranch extends Model
{
    use HasFactory;

    protected $table = 'patch_branchs';

    protected $fillable = ['port'];
}
