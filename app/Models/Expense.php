<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_type', // Assuming you have a relationship with ExpenseCategory
        'category_name',
    ];

    // Define a relationship to the ExpenseCategory model
    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'id');
    }
}
