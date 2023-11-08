<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $fillable = [
        'school',
        'branch',
        'class',
        'section',
        'subject',
    ];
}
