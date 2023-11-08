<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    //use UserstampsTrait;

    protected $dates = ['joining_date','leave_date'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id',
        'id_card',
        'name',
        'designation',
        'qualification',
        'dob',
        'gender',
        'religion',
        'email',
        'phone_no',
        'address',
        'joining_date',
        'leave_date',
        'photo',
        'signature',
        'shift',
        'duty_start',
        'duty_end',
        'status',
        'order'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function getGenderAttribute($value)
    {
        //return Arr::get(AppHelper::GENDER, $value);
    }

    public function getShiftAttribute($value)
    {
        //return Arr::get(AppHelper::EMP_SHIFTS, $value);
    }

    public function getDesignationAttribute($value)
    {
        //return Arr::get(AppHelper::EMPLOYEE_DESIGNATION_TYPES, $value);
    }


    public function setJoiningDateAttribute($value)
    {
        //$this->attributes['joining_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

    }
	
}
