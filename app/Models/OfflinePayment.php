<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'amount',
        'payment_date',
        'record_type',
    ];
}
