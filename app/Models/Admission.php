<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{

    use HasFactory;

    protected $table = 'admission';

    // Define relationships with other models
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function academy()
    {
        return $this->hasOne(Academy::class);
    }

    public function transport()
    {
        return $this->hasOne(Transport::class);
    }

    public function hostel()
    {
        return $this->hasOne(Hostel::class);
    }

    public function school()
    {
        return $this->hasOne(School::class);
    }
}
