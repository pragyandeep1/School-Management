<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\School;
use App\Models\Branch;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class SubjectController extends Controller
{

	public function addSubject(){
		$schools = School::all();
		$schData = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'DESC')
                  ->get();
		 return view('admin/subject/add-subject', [ 'school'=>$schools,'branch' => $schData ]);
    }
    public function save(Request $request){
			//if($res){
				$sch = new Subject;
			 
				DB::table('subject')->insert(
					array(
						'branch_id'  		=>   $request->branch_name,
						'subject_name'   	=>   $request->subject_name,
						'subject_code'   	=>   $request->subject_code,
						'subject_author'   	=>   $request->subject_author,
						'subject_type'   	=>   $request->subject_type,
					)
				);
			//}
        
        //DB::

        return redirect()->route('subject-list')->with('success', 'Subject created Successfully'); 
    }

    public function subjectList(){

       $schData = DB::table('subject')
                  ->select('*')
				  ->orderBy('id', 'DESC')
                  ->get();

       return view('admin/subject/subject_list', [ 'subject' => $schData ]); 
    }

    
	public function editSubject(Request $request){
        
        $schData = DB::table('subject')
                  ->select('*')
                  ->where(['id' => $request->id ])
                  ->get()->first();
       // dd($schData);
	   $schDataBranch = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'DESC')
                  ->get();

        return view('admin/subject/edit_subject', [ 'subject' => $schData, 'branch' => $schDataBranch ]);
    }
	

    public function updateSubject(Request $request){
        
        $sch = new Subject;
         
		$data = [
			'branch_id'  =>   $request->select_branch,
			'subject_name'   	=>   $request->subject_name,
			'subject_code'   	=>   $request->subject_code,
			'subject_author'   	=>   $request->subject_author,
			'subject_type'   	=>   $request->subject_type
		];

		DB::table('subject')
		->where('id', $request->d_id)
		->update($data);

		return redirect()->route('subject-list')->with('success', 'Successfully updated Subject.');
    }
	
	public function destroy(Request $request){
		//dd($request->id);
		DB::table('subject')->where('id', $request->id)->delete();
       
        return redirect()->back()->with('success', 'Subject deleted Successfully'); 
    }

    public function getTaskCount()
    {
        $taskCount = Subject::count();
        return response()->json(['userCount' => $taskCount]);
    }// end function

    public function subjectIndex(Request $request)
    {

        //for save on POST request
        if ($request->isMethod('post')) {//
            $this->validate($request, [
                'hiddenId' => 'required|integer',
            ]);
            $subject = Subject::findOrFail($request->get('hiddenId'));

            if(session('user_role_id',0) == AppHelper::USER_STUDENT){
                abort(401);
            }

            $subject->delete();

            //now notify the admins about this record
            $msg = $subject->name." subject deleted by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $msg);
            // Notification end

            //invalid dashboard cache
            Cache::forget('SubjectCount');

            return redirect()->route('academic.subject')->with('success', 'Record deleted!');
        }

        // check for ajax request here
        if($request->ajax()){
            $class_id = $request->query->get('class', 0);
            $subjectType = $request->query->get('type', 0);
            if(session('user_role_id',0) == AppHelper::USER_TEACHER){
                if(!auth()->user()->teacher){
                    return response('Access denied!', 401);
                }
                $teacherId = auth()->user()->teacher->id;
                $subjects = Subject::select('subjects.id', 'subjects.name as text')
                    ->where('class_id',$class_id)
                    ->sType($subjectType)
                    ->join('teacher_subjects','teacher_subjects.subject_id','subjects.id')
                    ->where('teacher_subjects.teacher_id', $teacherId)
                    ->where('subjects.status', AppHelper::ACTIVE)
                    ->orderBy('subjects.order','asc')
                    ->get();
            }
            else {
                $subjects = Subject::select('id', 'name as text')
                    ->where('class_id', $class_id)
                    ->sType($subjectType)
                    ->where('status', AppHelper::ACTIVE)
                    ->orderBy('order', 'asc')
                    ->get();
            }
            return $subjects;
        }


        $class_id = $request->query->get('class',0);
        $subjects = Subject::iclass($class_id)->with('teachers')
            ->with(['class' => function($q){
                $q->select('id','name');
            }])
            ->orderBy('order', 'asc')
            ->get();
        $classes = IClass::where('status', AppHelper::ACTIVE)
            ->orderBy('order','asc')
            ->pluck('name', 'id');
        $iclass = $class_id;
        return $classes;

        return view('admin.academic.subject.list', compact('subjects','classes', 'iclass'));
    }

    public function subjectCru(Request $request, $id=0)
    {
        //for save on POST request
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|min:1|max:255',
                'code' => 'required|min:1|max:255',
                'type' => 'required|numeric',
                'class_id' => 'required|integer',
                'teacher_id' => 'required|array',
                'order' => 'required|integer',
            ]);

            DB::beginTransaction();
            try {
                $data = $request->all();

                if($request->has('exclude_in_result')){
                    $data['exclude_in_result'] = true;
                }
                else{
                    $data['exclude_in_result'] = false;
                }

                $subject = Subject::updateOrCreate(
                    ['id' => $id],
                    $data
                );
                $subject->teachers()->sync($request->get('teacher_id'));
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $message = str_replace(array("\r", "\n", "'", "`"), ' ', $e->getMessage());
                return redirect()->back()->with("error", $message);
            }


            if(!$id){
                //now notify the admins about this record
                $msg = $data['name']." subject added by ".auth()->user()->name;
                $nothing = AppHelper::sendNotificationToAdmins('info', $msg);
                // Notification end

                //invalid dashboard cache
                Cache::forget('SubjectCount');
            }

            $msg = "subject ";
            $msg .= $id ? 'updated.' : 'added.';

            return redirect()->route('academic.subject')->with('success', $msg);
        }

        //for get request
        $subject = Subject::with('teachers')->where('id',$id)->first();

        $teachers = Employee::where('role_id', AppHelper::EMP_TEACHER)
            ->where('status', AppHelper::ACTIVE)
            ->orderBy('order', 'asc')
            ->pluck('name', 'id');
        $teacher_ids = [];

        $classes = IClass::where('status', AppHelper::ACTIVE)
            ->orderBy('order','asc')
            ->pluck('name', 'id');
        $iclass = null;
        $subjectType = null;
        $exclude_in_result = 0;

        if($subject){
            $teacher_ids = $subject->teachers->pluck('id')->toArray();
            $iclass = $subject->class_id;
            $subjectType = $subject->getOriginal('type');
            $exclude_in_result = $subject->exclude_in_result;
        }
        return view('backend.academic.subject.add', compact('subject', 'iclass', 'classes',
            'teachers', 'teacher_ids', 'subjectType', 'exclude_in_result'));

    }

    public function subjectStatus(Request $request, $id=0)
    {

        $subject =  Subject::findOrFail($id);
        if(!$subject){
            return [
                'success' => false,
                'message' => 'Record not found!'
            ];
        }

        $subject->status = (string)$request->get('status');

        $subject->save();

        return [
            'success' => true,
            'message' => 'Status updated.'
        ];

    }
}
