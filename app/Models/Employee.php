<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
	protected $fillable = [
        'emp_pic',
        'name',
        'email',
        'designation'
    ];
    // id   name    address principal_name  phone_no    phone_no_se area_pin_code   state   district    total_class total_student   total_teacher   total_support_employee  created_at  updated_at  


}
