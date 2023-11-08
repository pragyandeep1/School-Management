<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;
use App\Models\Branch;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';
	protected $fillable = ['school_name','branch_name','name','student'];

    // id   name    address principal_name  phone_no    phone_no_se area_pin_code   state   district    total_class total_student   total_teacher   total_support_employee  created_at  updated_at  

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function school()
	{
	    return $this->belongsTo(School::class,'school_id');
	}

    public function student()
    {
        return $this->hasMany(Student::class, 'teacher_id');
    }

}
