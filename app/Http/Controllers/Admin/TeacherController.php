<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GController;
use App\Models\Academic;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\Teacher;
use App\Models\School;
use App\Models\Branch;
use App\Models\IClass;
use App\Models\Section;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class TeacherController extends Controller
{
    
    public function dashboard(){
        $schData = DB::table('teacher')
                  ->select('*')
                  ->where(['email' => Auth::user()->email ])
                  ->first();
        return view('admin/dashboard/teacher',[ 'pics' => $schData->photo ]);
    }
    public function details($id){
        $teacher = DB::table('teacher')
                  ->select('*')
                  ->where(['id' => $id ])
                  ->get()->first();
  
        return response()->json($teacher);
    }

    
    public function create()
    {
        $schools = School::all(); 
        $branches = Branch::all();
        $gender = GController::GENDER;
        $religion = GController::RELIGION;
        $designation = GController::TEACHER_DESIGNATION_TYPES;
        return view('admin/teacher/add-teacher', compact('schools','branches', 'gender', 'religion', 'designation'));
    }//end function


    public function addTeacher(Request $request){
        $this->validate(
            $request, [
                'school' => 'required',
                'select_branch' => 'required',
                'teacher_name' => 'required|min:3|max:255',
                'photo' => 'mimes:jpeg,jpg,png',
                'designation' => 'required|integer',
                'qualification' => 'max:255',
                'dob' => 'min:10|max:10',
                'gender' => 'required|integer',
                'religion' => 'required|integer',
                'email' => 'email|max:255',
                'phone_no' => 'required|min:10|max:15',
                'address' => 'max:500',
                'leave_date' => 'nullable|min:10|max:10',
            ]
        );
        // return $request;
        $user = User::create([
            'name' => $request->teacher_name,
            'email' => $request->email,
            //'password' => $request->password,
             'password' => Hash::make('teacher@123'),
            'role'   => GController::USER_TEACHER
        ]);
        
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image_name = md5(rand(100, 999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/teacher');
            $image->move($path1, $image_name);
        } 

        if(!empty($user->id)){
            
            $sch = new Teacher;
            $sch->name              = $request->teacher_name;
            $sch->school_id   = $request->school;
            $sch->branch_id   = $request->select_branch;
            $sch->designation       =$request->designation;
            $sch->qualification         =$request->qualification;
            $sch->dob    = $request->dob;
            $sch->gender   = $request->gender;
            $sch->religion   = $request->religion;
            $sch->email    = $request->email;
            $sch->phone_no = $request->phone_no;
            $sch->address         = $request->address;
            $sch->joining_date    = $request->joining_date;
            $sch->id_card    = $request->id_card;
             //echo '<pre>'; print_r($sch); exit;
             $sch->photo = $image_name;
            $sch->save();
            // return $sch;

        }
        // return $sch->branch_id;
        return redirect()->route('teacher-list')->with('success', 'Teacher created successfully'); 
    }

    public function save(){
        return redirect()->route('teacher-list')->with('success', 'Teacher created successfully'); 
    }

    public function teacherList(){
        $teachers = Teacher::with('branch','school')
        ->orderBy('id', 'DESC')
        ->get();
        return view('admin/teacher/teacher-list', [ 'teachers' => $teachers ]); 
    }

    public function editTeacher(Request $request)
    {
        $schools = School::all();
        $branches = Branch::all();    
        $gender = GController::GENDER;
        $religion = GController::RELIGION;
        $designation = GController::TEACHER_DESIGNATION_TYPES;
        $teacher = DB::table('teacher')
                  ->select('*')
                  ->where(['id' => $request->id ])
                  ->get()->first();
        if (!$teacher) {
            return redirect()->route('teacher-list')->with('error', 'Teacher not found.');
        }
        
        return view('admin/teacher/edit-teacher', compact('teacher', 'schools', 'branches', 'gender', 'religion', 'designation'));

    }
    public function updateTeacher(Request $request)
    {
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image_name = md5(rand(1000, 9999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/teacher');
            $image->move($path1, $image_name);
        }

        $data = [
            'name'  =>   $request->name,
            'designation'  =>   $request->designation,
            'qualification'  =>   $request->qualification,
            'dob'  =>   $request->dob,
            'gender'  =>   $request->gender,
            'religion'  =>   $request->religion,
            'email'  =>   $request->email,
            'phone_no'  =>   $request->phone_no,
            'address'  =>   $request->address,
            'joining_date'  =>   $request->joining_date,
            'id_card'  =>   $request->id_card,
            'leave_date' => $request->leave_date,
            'photo' => $image_name,
        ];

        DB::table('teacher')
            ->where('id', $request->id)
            ->update($data);

        return redirect()->route('teacher-list')->with('success', 'Teacher information updated successfully');
    }

    public function destroy(Request $request)
    {
        DB::table('teacher')->where('id', $request->id)->delete();
        return redirect()->route('teacher-list')->with('success', 'Teacher information deleted successfully');
    }

    public function getTeachers($branchId) {
        $teachers = Teacher::where('branch_id', $branchId)->pluck('name', 'id');

        return response()->json($teachers);
    }

}