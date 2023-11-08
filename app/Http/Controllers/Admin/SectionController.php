<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Academy;
use App\Models\School;
use App\Models\Branch;
use App\Models\IClass;
use App\Models\OnlineClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Traits\MeetingZoomTrait;
use DB;
class SectionController extends Controller
{

    public function sectionCru(Request $request, $id = 0)
    {
    // Check if it's a POST request to add or edit a section
    if ($request->isMethod('post')) {
        // Validate the form data
        $this->validate($request, [
            'name' => 'required|min:1|max:255',
            'capacity' => 'required|numeric',
            'select_class' => 'required',
            'select_teacher' => 'required',
            'select_branch' => 'required',
            'school' => 'required',
        ]);

        $data = new Section();
        if ($id) {
            // If $id is provided, it's an edit operation
            $data = Section::find($id);
        }

        $data->name = $request->name;
        $data->capacity = $request->capacity;
        $data->class_id = $request->select_class;
        $data->teacher_id = $request->select_teacher;
        $data->branch_id = $request->select_branch;
        $data->school_id = $request->school;
        $data->save();

        $msg = $id ? 'Section updated.' : 'Section added.';

        if (!$id) {
            // Notify the admins about the new record
            $msg = $data->name . ' section added by ' . auth()->user()->name;
        }

        return redirect()->route('academic.section')->with('success', $msg);
    }

    // For GET request, prepare data for the form
    $teachers = DB::table('teacher')
        ->select('id', 'name')
        ->orderBy('name', 'ASC')
        ->get();

    $classes = DB::table('i_classes')
        ->select('id', 'name')
        ->orderBy('name', 'ASC')
        ->get();

    $schools = DB::table('school')
        ->select('id', 'name')
        ->orderBy('name', 'ASC')
        ->get();

    $branches = DB::table('branch')
        ->select('id', 'branch_name')
        ->orderBy('branch_name', 'ASC')
        ->get();

    $section = Section::find($id);

    return view('admin.academic.section.add_section', compact('section', 'teachers', 'classes', 'schools', 'branches'));
}


    public function sectionIndex(Request $request)
    {

        //for save on POST request
        if ($request->isMethod('post')) {
            DB::table('sections')->where('id', $request->get('hiddenId'))->delete();
            return redirect()->route('academic.section')->with('success', 'Record deleted!');
        }
        $sections = DB::table('sections')
                  ->select('sections.*','i_classes.name as class_name','teacher.name as teacher_name','school.name as school_name','branch.branch_name as branch_name')
                  ->join('i_classes', 'i_classes.id', '=', 'sections.class_id')
                  ->join('teacher', 'teacher.id', '=', 'sections.teacher_id')
                  ->join('school', 'school.id', '=', 'teacher.school_id')
                  ->join('branch', 'branch.id', '=', 'teacher.branch_id')
                  ->orderBy('id', 'DESC')
                  ->get();
        // echo '<pre>'; print_r($sections); exit;

        return view('admin.academic.section.section_list', compact('sections'));
    }

     public function sectionStatus(Request $request, $id=0)
    {

        $section =  Section::findOrFail($id);
        if(!$section){
            return [
                'success' => false,
                'message' => 'Record not found!'
            ];
        }

        $section->status = (string)$request->get('status');

        $section->save();

        return [
            'success' => true,
            'message' => 'Status updated.'
        ];

    }

    public function getSections($classId) {
        $sections = Section::where('class_id', $classId)->pluck('name', 'id');

        return response()->json($sections);
    }
}
