<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'school';
    protected $fillable = ['name','image'];
    // id   name    address principal_name  phone_no    phone_no_se area_pin_code   state   district    total_class total_student   total_teacher   total_support_employee  created_at  updated_at  

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public static function boot()
    {
        parent::boot();

        static::deleting(function ($school) {
             \Log::info('Deleting school: ' . $school->id);
            \Log::info('Associated user ID: ' . $school->user->id);
            $school->user->delete();
        });
    }


	public function branches()
	{
	    return $this->hasMany(Branch::class, 'school_id');
	}

	// Define a relationship to fetch all teachers in the school
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'school_id');
    }

    // Define a relationship to fetch all students in the school
    public function students()
    {
        return $this->hasMany(Student::class, 'school_id');
    }

    // Define a relationship to fetch all classes in the school
    public function classes()
    {
        return $this->hasMany(IClass::class, 'school_id');
    }

    // Define a relationship to fetch all sections in the school
    public function sections()
    {
        return $this->hasMany(Section::class, 'school_id');
    }

}
 