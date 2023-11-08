<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Hrshadhin\Userstamps\UserstampsTrait;

class IClass extends Model
{
    use SoftDeletes;
    protected $table = 'i_classes';
    protected $fillable = [
        'name',
        'school_id',
        'branch_id',
        'duration'
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function teacher()
    {
        return $this->hasMany(Teacher::class, 'teacher_id');
    }  

    public function student()
    {
        return $this->hasMany(Student::class, 'student_id');
    }

    public function section()
    {
        return $this->hasMany(Section::class, 'section_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'attendance_id');
    }
}
