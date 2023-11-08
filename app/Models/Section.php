<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Hrshadhin\Userstamps\UserstampsTrait;

class Section extends Model
{
    use SoftDeletes;
    //use UserstampsTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'capacity',
        'class_id',
        'teacher_id',
        'note',
        'status',
        'subject_id',
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
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function classes()
    {
        return $this->belongsTo(IClass::class, 'class_id');
    }

    public function marks()
    {
        return $this->hasMany('App\Mark', 'section_id');
    }

    public function student()
    {
        return $this->hasMany('App\Registration', 'section_id');
    }

    public function subject()
    {
        return $this->hasMany(IClass::class, 'subject_id');
    }
}
