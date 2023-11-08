<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branch';
    protected $fillable = ['branch_name','currency','currency_symbol','system_logo','text_logo',     'printing_logo','report_card'];
    // id   name    address principal_name  phone_no    phone_no_se area_pin_code   state   district    total_class total_student   total_teacher   total_support_employee  created_at  updated_at  

	public function school() {
        return $this->belongsTo(School::class);
    }

    public function teacher() {
        return $this->hasMany(Teacher::class);
    }

    public function student() {
        return $this->hasMany(Student::class);
    }

    

}
