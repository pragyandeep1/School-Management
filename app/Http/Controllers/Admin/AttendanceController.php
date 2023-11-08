<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

class AttendanceController extends Controller
{

    public function attendance(Request $request)
    {
        DB::enableQueryLog();
        $schoolData = DB::table('school')
            ->select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();
        $schData = DB::table('branch')
            ->select('id', 'branch_name')
            ->orderBy('branch_name', 'ASC')
            ->get();
        $teacherData = DB::table('teacher')
            ->select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();
        $classData = DB::table('i_classes')
            ->select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();
        $section = DB::table('sections')
            ->select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();

        $results = [];

        if ($request->isMethod('post')) {
            // Handle the form submission and search for attendance
            $schools = $request->input('school');
            $branches = $request->input('select_branch');
            $teachers = $request->input('select_teacher');
            $classes = $request->input('select_class');
            $sections = $request->input('select_section');
            $dates = $request->input('scheduledate');
            $results = Attendance::where('school_id', 'like', '%' . $schools . '%')
                ->get();
        }

        return view('admin/attendance/attendance-form', [
            'branch' => $schData,
            'school' => $schoolData,
            'teacher' => $teacherData,
            'class' => $classData,
            'section' => $section,
            'results' => $results,
        ]);
    }


    public function updatePresent(Request $request, $id)
    {

        Attendance::where('id', $id)->update(['status' => 0]);

        return redirect('attendance-form')->with('danger', 'Student attendance marked as Absent');

    }// end function

    public function updateAbsent(Request $request, $id)
   {

       Attendance::where('id', $id)->update(['status' => 1]);

    return redirect('attendance-form')->with('success', 'Student attendance marked as Present');

   }// end function

   /*public function studentReport(Request $request)
    {
        // Retrieve request parameters
        $studentId = $request->input('student_id');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
    }*/
}