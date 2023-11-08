<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use App\Models\Section;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\GController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;
use DB;

class SchoolController extends Controller
{
    public function addSch(){

        $schData = School::where('user_id', Auth::user()->id)->first();
        $state = GController::STATE;
        return view('admin/school/add-school', ['pics' => $schData,'state'=>$state]);
    }// end function

    public function save(Request $request){
    $request->validate([
        'name' => ['required', 'min:3'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'state' => ['required'],
    ]);

    $password = "School@123";
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($password),
        'role'   => GController::USER_SCHOOL,

    ]);
if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image_name = md5(rand(1000, 9999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/school_images');
            $image->move($path1, $image_name);
        } 
    

    if(!empty($user->id)){
        
        $sch = new School;
        
        $sch->user_id          = $user->id;
        $sch->name             = $request->name;
        $sch->address          = $request->address;
        $sch->principal_name   = $request->principal_name;
        $sch->phone_no         = $request->phone_no;
        $sch->phone_no_se      = $request->phone_no_se;
        
        $sch->area_pin_code    = $request->area_pin_code;
        $sch->state            = $request->state;
        $sch->district         = $request->district;
        $sch->total_class      = $request->total_class;
        $sch->total_student    = $request->total_student;
        $sch->total_teacher    = $request->total_teacher;
        $sch->total_support_employee = $request->total_support_employee;
        $sch->image            = $image_name;
        $sch->save();
        // return $sch;
    }
    return redirect()->route('school-list')->with('success', 'School Created Successfully');
}
// end function

    public function schoolList(){

       $schData = DB::table('school')
                  ->select('school.*','users.email as user_email')
                  ->join('users','users.id','=','school.user_id')
                  ->orderBy('users.id', 'desc')
                  ->get();
                  // return $schData;exit();

       return view('admin/school/school_list', [ 'schools' => $schData ]); 
    }// end function

    public function update(Request $request){
        $schData = DB::table('school')
                  ->select('*')
                  ->join('users','users.id','=','school.user_id')
                  ->where(['school.user_id' => $request->id ])
                  ->get()->first();
        $state = GController::STATE;
        //dd($schData);

        return view('admin/school/update_school', [ 'school' => $schData, 'state' => $state ]); 

    }// end function

    public function updateSchool(Request $request){
        // return $request;
        // $sch = new School;
        // $school = School::find($request->id);


        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image_name = md5(rand(1000, 9999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/school_images');
            $image->move($path1, $image_name);
        }
            $data = [
                'name' => $request->name,
                'address'=> $request->address,
                'principal_name' => $request->principal_name,
                'phone_no' => $request->phone_no,
                'phone_no_se' => $request->phone_no_se,
                'area_pin_code' => $request->area_pin_code,
                'state' => $request->state,
                'district'  => $request->district,
                'total_class' => $request->total_class,
                'total_student' => $request->total_student,
                'total_teacher' => $request->total_teacher,
                'total_support_employee' => $request->total_support_employee,
                'image' => $image_name,
            ];
            // $sch->where('user_id', $request->user_id);
            // $sch->update($data);

            DB::table('school')
            ->where('user_id', $request->user_id)
            ->update($data);


            return redirect()->route('school-list')->with('success', 'School Info Updated Succefully');
    }// end function

    public function deleteSchool(Request $request, $user_id)
    {
        School::where('user_id', $user_id)->delete();
        User::where('id', '=', $user_id)->delete();

        // Redirect back with a success message
        return redirect('/school-list')->with('success', 'School deleted successfully');
    }// end function

    public function updateStatus(Request $request, $id)
   {

       School::where('id', $id)->update(['status' => 0]);

    return redirect('/school-list')->with('danger', 'School Status Inactive');

   }// end function

   public function inactiveUpdateStatus(Request $request, $id)
   {

       School::where('id', $id)->update(['status' => 1]);

    return redirect('/school-list')->with('success', 'School Status Active');

   }// end function

    public function getBranches($schoolId)
    {
        $school = School::find($schoolId);

        if ($school) {
            $branches = $school->branches;
            // Add debug statement to log the data
            // dd($branches);
            return response()->json($branches);
        }

        return response()->json([]);
    }// end function


}
