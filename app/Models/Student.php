<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Attendance;
use App\Models\IClass;


class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
	protected $fillable = [
		'name',
        'student_pic',
        'class',
        'section',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function iClass()
	{
	    return $this->belongsTo(IClass::class, 'class_id');
	}

    /*public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }*/

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }



}
