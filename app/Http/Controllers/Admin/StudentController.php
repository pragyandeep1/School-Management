<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\GController;
use App\Models\User;
use App\Models\Admission;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Branch;
use App\Models\Academy;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Transport;
use App\Models\Hostel;
use App\Models\School;
use App\Models\IClass;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Attendance;
use DB;

class StudentController extends Controller
{
    public function registerForm(){
        return view('admin/student/register');
    }
	
	public function fetchBranch(){
    $schools = School::all();
        $classes = IClass::all();
    $schData = DB::table('branch')
                  ->select('id','branch_name')
          ->orderBy('id', 'DESC')
                  ->get();
        $gender = GController::GENDER;
        $blood_group = GController::BLOOD_GROUP;
        $religion = GController::RELIGION;
        $state = GController::STATE;
        $section = DB::table('sections')
                  ->select('id','name')
                  ->orderBy('id', 'DESC')
                  ->get();
        $teachers = DB::table('teacher')
                  ->select('id','name')
                  ->orderBy('id', 'DESC')
                  ->get();
     return view('admin/student/register', ['school' => $schools, 'branch' => $schData, 'class' => $classes, 'gender' => $gender, 'section' => $section, 'blood_group'=>$blood_group, 'religion' => $religion, 'teachers'=> $teachers, 'state' => $state]);
    }
	
    public function save(Request $request){
      // return $request;
    	$request->validate([
            'name' => ['required','min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

		$user = User::create([
            'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make('student@123'),
            'role'   => GController::USER_STUDENT,
        ]);
		
		if(!empty($user->id)){

      if ($request->hasFile('student_pic')) {
            $image = $request->file('student_pic');
            $image_name = md5(rand(1000, 9999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/student_images');
            $image->move($path1, $image_name);
        }

			$sch = new Student;
      $attendance = new Attendance;
        $sch->user_id = $user->id;
        $sch->name = $request->name;
        $sch->registration_no = $request->registration_no;
        $sch->class_id = $request->select_class;
        $sch->date_of_birth = $request->date_of_birth;
        $sch->roll_no = $request->roll_no;
        $sch->gender = $request->gender;
        $sch->language = $request->language;
        $sch->religion = $request->religion;
        $sch->school_id = $request->school;
        $sch->branch_id = $request->select_branch;
        $sch->teacher_id = $request->select_teacher;
        $sch->section_id = $request->select_section;
        $sch->category = $request->category;
        $sch->father = $request->father;
        $sch->mother = $request->mother;
        $sch->guardian_email = $request->guardian_email;
        $sch->phone_no = $request->phone_no;
        $sch->city = $request->city;
        $sch->state = $request->state;
        $sch->guardian_phone = $request->secondary_phone_no;
        $sch->permanent_add = $request->permanent_add;
        $sch->curr_add = $request->curr_add;
        $sch->father = $request->father;
        $sch->mother = $request->mother;
        $sch->guardian_name = $request->guardian_name;
        $sch->relation = $request->relation;
        $sch->occupation = $request->occupation;
        $sch->income = $request->income;
        $sch->blood_group = $request->blood_group;
        $sch->date_of_join = $request->date_of_join;
        $sch->student_pic = $image_name;
        // echo '<pre>'; print_r($sch); exit;

        $attendance->name = $request->name;
        $attendance->roll_no = $request->roll_no;
        $attendance->class_id = $request->select_class;
        $attendance->section_id = $request->select_section;
        $attendance->school_id = $request->school;
        $attendance->branch_id = $request->select_branch;
        $attendance->teacher_id = $request->select_teacher;
        $attendance->status = '1';
        $sch->save();
        $attendance->save();
    }
    // return $request;

    return redirect()->route('student-list')->with('success', 'Student created Successfully');
       
    }

    public function studentList(){
		$schData = Student::with('iClass','section')
		   ->orderBy('id', 'DESC')
		   ->get();
		return view('admin/student/student-list', [ 'student' => $schData ]); 
    }
	
	public function editStudent(Request $request){
		$schData = DB::table('student')
                  ->select('*')
                  ->where(['id' => $request->id ])
                  ->get()->first();
		$branchData = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'DESC')
                  ->get();
		$schoolData = DB::table('school')
                  ->select('id','name')
				  ->orderBy('id', 'DESC')
                  ->get();
    $teacherData = DB::table('teacher')
                  ->select('id','name')
          ->orderBy('id', 'DESC')
                  ->get();
		$classData = DB::table('i_classes')
                  ->select('id','name')
				  ->orderBy('id', 'DESC')
                  ->get();
        $sectionData = DB::table('sections')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
    $blood_group = GController::BLOOD_GROUP;

    // return $blood_group;
        return view('admin/student/edit_student', [ 'student' => $schData, 'branch' => $branchData, 'school' => $schoolData, 'class' => $classData, 'section' => $sectionData, 'teacher' => $teacherData, 'blood_group' => $blood_group]); 

    }
	
	public function updateStudent(Request $request){

        if ($request->hasFile('student_pic')) {
            $image = $request->file('student_pic');
            $image_name = md5(rand(1000, 9999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/student_images');
            $image->move($path1, $image_name);
        }

            $data = [
		        'name' => $request->name,
		        'school_id' => $request->school,
		        'branch_id' => $request->select_branch,
            'teacher_id' => $request->select_teacher,
		        'class_id' => $request->select_class,
		        'section_id' => $request->select_section,
		        'phone_no' => $request->phone_no,
            'student_pic' => $image_name,
            'blood_group' => $request->blood_group,
		    ];

	        DB::table('student')
            ->where('id', $request->student_id)
            ->update($data);
            // return $data;
            return redirect()->route('student-list')->with('success', 'Student Details Updated Successfully');
    }

    public function deleteStudent($id)
  	{
  	    
        Student::where('id', $id)->delete();
        Attendance::where('attendance.student_id', '=', $id)->delete();
        
  	    return redirect()->route('student-list'); 
  	}

  public function getStudents($sectionId) {
        $students = Student::where('section_id', $sectionId)->pluck('student_name', 'id');

        return response()->json($students);
    }


}
