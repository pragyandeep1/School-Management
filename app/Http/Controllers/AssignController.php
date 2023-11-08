<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assign;
use App\Models\School;
use App\Models\Branch;
use App\Models\Section;
use DB;

class AssignController extends Controller
{
    public function index()
    {
        $assignments = Assign::all();
        return view('admin.academic.assignment.assign_list', compact('assignments'));
    }

    public function create()
    {
        $schools = School::all();
        $branches = Branch::all();
        $sections = Section::all();
        return view('admin.academic.assignment.add_assign', compact('schools','branches','sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch' => 'required',
            'class' => 'required',
            'section' => 'required',
            'subject' => 'required'
        ]);

        $assignment = new Assign();
        $assignment->branch = $request->input('branch');
        $assignment->class = $request->input('class');
        $assignment->section = $request->input('section');
        $assignment->subject = $request->input('selected_subjects');
        $assignment->save();
        return redirect()->route('assignments.index');
    }

    public function edit(Request $request,$id)
    {
        $assignment = Assign::findOrFail($id);
        $schools = School::all();
        $branches = Branch::all();
        $sections = Section::all();

        $schoolData = DB::table('school')
                  ->select('id','name')
                  ->orderBy('id', 'DESC')
                  ->get();
        $schData = DB::table('branch')
                  ->select('id','branch_name')
                  ->orderBy('id', 'DESC')
                  ->get();
        $classData = DB::table('i_classes')
                  ->select('id','name')
                  ->orderBy('id', 'DESC')
                  ->get();
        $section = DB::table('sections')
                  ->select('id','name')
                  ->orderBy('id', 'DESC')
                  ->get();
        $teacher = DB::table('teacher')
                  ->select('*')
                  ->orderBy('id', 'DESC')
                  ->get();
    $subject = DB::table('subject')
                  ->select('*')
          ->orderBy('id', 'DESC')
                  ->get();

        $liveClassList = DB::table('live_class')
                 ->select('*','school.id as sch_id','branch.id as brch_id','i_classes.id as cl_id','sections.id as sce_id','teacher.id as tech_id','subject.id as sub_id')
                 ->join('school','school.id', '=', 'live_class.school_id')
                 ->join('branch','branch.id', '=', 'live_class.branch_id')
                 ->join('i_classes','i_classes.id', '=', 'live_class.class_id')
                 ->join('sections','sections.id', '=', 'live_class.section')
                 ->join('teacher','teacher.id', '=', 'live_class.teacher') 
         ->join('subject','subject.id', '=', 'live_class.subject')
                 ->where(['live_class.id' => $request->id ])
                 ->get()->first();

        return view('admin.academic.assignment.edit_assign', [ 'liveResult' => $liveClassList, 'branch' => $schData, 'school' => $schoolData, 'class' => $classData, 'section'=>$section, 'teacher'=>$teacher, 'subject'=>$subject ]);
    }

    public function update(Request $request, $id)
    {
        $assignment = Assign::findOrFail($id);
        $assignment->branch = $request->input('branch');
        $assignment->class = $request->input('class');
        $assignment->section = $request->input('section');
        $assignment->subject = $request->input('subject');
        $assignment->save();
        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully');
    }


}
