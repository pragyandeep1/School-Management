<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IClass; // Replace 'YourClassModel' with the actual model name
use App\Models\School;
use App\Models\Branch;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
// use App\Models\Teacher;
use DB;

class ClassController extends Controller
{

    public function classIndex(Request $request)
    {
        if ($request->isMethod('post')) {
        
            $this->validate($request, [
                'hiddenId' => 'required|integer',
            ]);
            $iclass = IClass::findOrFail($request->get('hiddenId'));

            $haveSection = Section::where('class_id', $iclass->id)->count();
           // $haveStudent = Registration::where('class_id', $iclass->id)->count();
            if($haveSection){
                return redirect()->route('academic.class')->with('error', 'Can not delete! Class used in section or have student.');
            }

            $iclass->delete();

            return redirect()->route('academic.class')->with('success', 'Record deleted!');
        }

        $classes = DB::table('i_classes')
        ->select('i_classes.*','school.name as school_name','branch.branch_name')
            ->join('school', 'school.id', '=', 'i_classes.school_id')
            ->join('branch', 'branch.id', '=', 'i_classes.branch_id')
            // ->join('teacher', 'teacher.id', '=', 'i_classes.teacher_id')
            ->orderBy('i_classes.id', 'DESC')
            ->get();
        return view('admin/academic/iclass/class_list', compact('classes'));
    }

    public function addClass(){
        $classData = DB::table('i_classes')
                  ->select('id','name')
                  ->orderBy('id', 'ASC')
                  ->get();
        $schools = DB::table('school')
               ->select('id', 'name')
               ->get();
        $branches = DB::table('branch')
               ->select('id', 'branch_name')
               ->get();
        /*$teacher = DB::table('teacher')
               ->select('id', 'name')
               ->get();*/
        return view('admin/academic/iclass/add_class', ['iclasses' => $classData, 'schools' => $schools, 'branches' => $branches]);
    }


    public function saveClass(Request $request){
        // return $request;
    $request->validate([
            'school' => 'required',
            'select_branch' => 'required',
            'name'      => 'required|min:2|max:255'
        ]);
    


        
        $sch = new IClass;
        
        $sch->school_id        = $request->school;  
        $sch->branch_id         = $request->select_branch;
        $sch->name       = $request->name;
        $sch->duration = 1;
        $sch->save();
        // return $sch;

    return redirect()->route('academic.class')->with('success', 'Class Created Successfully');
}

public function update(Request $request){
        $schools = School::all();
        $branches = Branch::all();    
        $iclass = DB::table('i_classes')
                  ->select('*')
                  ->where(['id' => $request->id ])
                  ->get()->first();
        // return $iclass;

        return view('admin/academic/iclass/edit_class', [ 'schools' => $schools, 'branches' => $branches, 'iclasses' => $iclass ]); 

    }// end function
   
    public function updateClass(Request $request){
        
            $data = [
                'school_id'        => $request->school,  
                'branch_id'         => $request->select_branch,
                'name'       => $request->name,
                'duration' => 1,
            ];

            DB::table('i_classes')
            ->where('id', $request->id)
            ->update($data);
            // return $request->id;

            return redirect()->route('academic.class')->with('success', 'Class Info Updated Succefully');
    }

    

    public function getClasses($branchId) {
        $classes = IClass::where('branch_id', $branchId)->pluck('name', 'id');

        return response()->json($classes);
    }// end function

    public function destroy(Request $request)
    {

        DB::table('i_classes')->where('id', $request->id)->delete();
        return redirect()->route('academic.class')->with('success', 'Class information deleted successfully');
    }// end function

   }