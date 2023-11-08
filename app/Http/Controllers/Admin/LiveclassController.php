<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Academic;
use App\Models\Liveclass;
use App\Models\Student;
use App\Models\Subject;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\Http\Traits\GradeTrait;
use App\Providers\RouteServiceProvider;
use App\Services\Attendance\AttendanceService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\TestUserMail;
use App\Models\School;
use App\Models\Branch;
use Illuminate\Support\Carbon;
use Mail;
use DB;

class LiveclassController extends Controller
{
	/*public function __construct(){
		
	}*/
    public function index(Request $request)
    {
		
			$attendances = $this->searchStudent($request);
			return view('admin/attendance/attendance', [ 'attendances'=>$attendances ]);
		
    }

public function liveclassList(){
    $user = auth()->user();
     $currentDate = Carbon::now();

    // Check if the user is an admin
    if ($user->role != 5) {
        // Admin can view all live classes
        $live_class = DB::table('live_class')
            ->join('school', 'school.id', '=', 'live_class.school_id')
            ->join('branch', 'branch.id', '=', 'live_class.branch_id')
            ->join('i_classes', 'i_classes.id', '=', 'live_class.class_id')
            ->join('sections', 'sections.id', '=', 'live_class.section')
            ->join('teacher', 'teacher.id', '=', 'live_class.teacher')
            ->join('subject', 'subject.id', '=', 'live_class.subject')
            ->select('*', 'live_class.id', 'school.name as school_name', 'branch.branch_name', 'i_classes.name as class_name', 'sections.name as section_name', 'teacher.name as teacher_name', 'subject.subject_name as subject')
            ->whereDate('live_class.class_date', '>=', $currentDate) // Filter out past dates
            ->orderBy('live_class.class_date', 'desc') // Order by class_date in descending order
            ->get();
    } else {
        // Check if the user is a student
        if ($user->role == 5) {
            // Students can view live classes specific to their class and section
            $studentData = DB::table('student')
                ->where('user_id', $user->id)
                ->select('class_id', 'section_id')
                ->first();

            if ($studentData) {
                $live_class = DB::table('live_class')
                    ->join('school', 'school.id', '=', 'live_class.school_id')
                    ->join('branch', 'branch.id', '=', 'live_class.branch_id')
                    ->join('i_classes', 'i_classes.id', '=', 'live_class.class_id')
                    ->join('sections', 'sections.id', '=', 'live_class.section')
                    ->join('teacher', 'teacher.id', '=', 'live_class.teacher')
                    ->join('subject', 'subject.id', '=', 'live_class.subject')
                    ->where('live_class.class_id', $studentData->class_id)
                    ->where('live_class.section', $studentData->section_id)
                    ->select('*', 'live_class.id', 'school.name as school_name', 'branch.branch_name', 'i_classes.name as class_name', 'sections.name as section_name', 'teacher.name as teacher_name', 'subject.subject_name as subject')
                    ->whereDate('live_class.class_date', '>=', $currentDate) // Filter out past dates
                    ->orderBy('live_class.class_date', 'desc') // Order by class_date in descending order
                    ->get();
            } else {
                // Handle the case when the user is not a student with class and section information
                $live_class = [];
            }
        } else {
            // Handle other user roles here
            $live_class = [];
        }
    }
    // return $live_class;
    return view('admin/academic/live-class/liveclass-list', ['liveclass' => $live_class]);
}


	public function storeLiveClass(Request $request){
		//dd($request); exit;
		/*
		`id`, `school_id`, `class`, `section`, `teacher`, `zoom_link`, `meeting_id`, `class_date`, `start_time`, `end_time`, `nb`*/
		
			$sch = new Liveclass;
			$sch->school_id      	 = $request->school;
			$sch->branch_id      	 = $request->select_branch;
			$sch->class_id      	 = $request->class_id;
			$sch->section          = $request->section;
			$sch->teacher          = $request->teacher_id;
      $sch->subject          = $request->subject_id;
			$sch->meeting_id       = uniqid();
      $sch->class_date       = $request->class_date;
			$sch->start_time       = $request->start_time;
			$sch->end_time         = $request->end_time;
			$sch->nb               = $request->description;
			$sch->save();
		// return back()->with('status',__('Saved'));
		//$sch->save();
      return redirect()->route('liveclass-list')->with('success', 'Class added successfully');
		
	}
	public function createLiveClass(){
      
		$schoolData = DB::table('school')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
        $schData = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$classData = DB::table('i_classes')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$section = DB::table('sections')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$teacher = DB::table('teacher')
                  ->select('*')
				  ->orderBy('id', 'ASC')
                  ->get();
    $subject = DB::table('subject')
                  ->select('*')
          ->orderBy('id', 'ASC')
                  ->get();

		return view('admin/academic/live-class/live-class', [ 'branch' => $schData, 'schools' => $schoolData, 'class' => $classData, 'section'=>$section, 'teacher'=>$teacher, 'subject'=>$subject]);
    }
	public function editLiveClass(Request $request){
      
		$schoolData = DB::table('school')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
        $schData = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'ASC')
                  ->get();

		$classData = DB::table('i_classes')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$section = DB::table('sections')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$teacher = DB::table('teacher')
                  ->select('*')
				  ->orderBy('id', 'ASC')
                  ->get();
    $subject = DB::table('subject')
                  ->select('*')
          ->orderBy('id', 'ASC')
                  ->get();
		/*$liveClassList = DB::table('live_class')
                  ->select('*')
				  ->where(['id' => $request->id ])
                  ->get()->first();*/

		$liveClassList = DB::table('live_class')
                 ->select('live_class.*','school.id as sch_id','branch.id as brch_id','i_classes.id as cl_id','sections.id as sce_id','teacher.id as tech_id','subject.id as sub_id')
				 ->join('school','school.id', '=', 'live_class.school_id')
				 ->join('branch','branch.id', '=', 'live_class.branch_id')
				 ->join('i_classes','i_classes.id', '=', 'live_class.class_id')
				 ->join('sections','sections.id', '=', 'live_class.section')
				 ->join('teacher','teacher.id', '=', 'live_class.teacher') 
         ->join('subject','subject.id', '=', 'live_class.subject')
				 ->where(['live_class.id' => $request->id ])
                 ->first();
				 // return $liveClassList; 
        // return $schData;
		return view('admin/academic/live-class/edit-live-class', [ 'liveResult' => $liveClassList, 'branch' => $schData, 'school' => $schoolData, 'class' => $classData, 'section'=>$section, 'teacher'=>$teacher, 'subject'=>$subject ]);
    }

  public function updateLiveClass(Request $request){
    $sch = new Liveclass;

            $data = [
                'school_id' => $request->school,
                'branch_id'=> $request->select_branch,
                'class_id' => $request->class_id,
                'section' => $request->section,
                'teacher' => $request->teacher_id,
                'subject' => $request->subject_id,
                'meeting_id' => $request->meeting_id,
                'class_date'  => $request->class_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'nb' => $request->description
            ];

            DB::table('live_class')
            ->where('id', $request->id)
            ->update($data);


            return redirect()->route('liveclass-list')->with('success', 'Live Class Updated Succefully');
  }

	public function getBranchName($ids){
		$data['branch'] = DB::table('branch')
                  ->select('id','branch_name')
				  ->where('school_id', $ids)
                  ->get();
		return response()->json($data);   
	}
	public function searchStudent(Request $request){
      
      $student = DB::table('attendance')
                  ->select('*')
				  ->orderBy('id', 'ASC')
                  ->get();

      
	  return $student;   
    }
    /**
     * View for Adjust missing Attendances
     *
     * @return \Illuminate\Http\Response
     */
    public function adjust(Request $request){
		$schoolData = DB::table('school')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
        $schData = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$classData = DB::table('i_classes')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$section = DB::table('sections')
                  ->select('id','name')
				  ->orderBy('id', 'ASC')
                  ->get();
		$students = $this->searchStudent($request);
			$attendances = $this->attStudent();
			$request_stg = [
            'isPresent' => [1,0,1],
			];
		$data = [
                'present' => 1
            ];
			
            DB::table('attendances')
            ->where('student_id', $request->student_id)
            ->update($data);
      return view('admin/attendance/attendance', [ 'branch' => $schData, 'school' => $schoolData, 'class' => $classData, 'section'=>$section , 'students'=>$students, 'attendances'=>$attendances, 'request_stg'=>$request_stg ]);
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * Adjust missing Attendances POST request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adjustPost(Request $request){
      $request->validate([
        'att_id' => 'required|array',
      ]);
      return $this->attendanceService->adjustPost($request);
    }
    /**
      * Add students to a Course before taking attendances
      * @return \Illuminate\Http\Response
    */
    public function addStudentsToCourseBeforeAtt($teacher_id,$course_id,$exam_id,$section_id){
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
       
        $students = $this->attendanceService->getStudentsBySection($section_id);
        $attendances = $this->attendanceService->getTodaysAttendanceBySectionId($section_id);
        $attCount = $this->attendanceService->getAllAttendanceBySecAndExam($section_id,$exam_id);

        return view('attendance.attendance', [
          'students' => $students,
          'attendances' => $attendances,
          'attCount' => $attCount,
          'section_id'=>$section_id,
          'exam_id'=>$exam_id
        ]);
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * View students of a section to view attendances
     * @return \Illuminate\Http\Response
    */
   
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
      $this->attendanceService->request = $request;
      if($request->update == 1){
        $at = $this->attendanceService->updateAttendance();
        if(isset($at))
          if(count($at) > 0)
            Attendance::insert($at);
      } else {
        $this->attendanceService->storeAttendance();
      }
      return back()->with('status',__('Saved'));
    }
	
	public function sendMail()
    {
        $users = User::all();
        
        if ($users->count() > 0) {
            foreach($users as $key => $value){
                if (!empty($value->email)) {
                    $details = [
                      'subject' => 'Test From Nicesnippets.com',
                    ];

                    Mail::to($value->email)->send(new TestUserMail($details));
                }
            }
        }

        return response()->json(['done']);
    }

    public function deleteLiveClass($id)
    {
        // Find and delete the live class with the given $id.
        $liveClass = LiveClass::find($id);
        if ($liveClass) {
        // Delete the live class.
            $liveClass->delete();
            session()->flash('success', 'Live class deleted successfully');
            // Redirect or return a response to the appropriate page after successful deletion.
            return redirect()->route('liveclass-list');
        }
    }


}
