<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use App\Models\Branch;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\GController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class BranchController extends Controller
{
    public function addBranch(){
        $schoolData = DB::table('school')
                  ->select('id','name')
				  ->orderBy('id', 'desc')
                  ->get();
        $state = GController::STATE;
        // return $state;
        return view('admin/branch/add-branch', [ 'school' => $schoolData, 'state' => $state ]);
    }// end function

   public function save(Request $request){
    // return $request;
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $password = "Digi@123";
        $user = User::create([
            'name' => $request->branch_name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role'   => GController::USER_BRANCH,
        ]);

        if(!empty($user->id)){


        if ($request->hasFile('system_logo')) {
            $image = $request->file('system_logo');
            $image_name = md5(rand(1000, 9999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image->move($path1, $image_name);
        } 

        if ($request->hasFile('text_logo')) {
            $image1 = $request->file('text_logo');
            $image_name1 = md5(rand(1000, 9999) . time()) . '.' . $image1->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image1->move($path1, $image_name1);
        } 

        if ($request->hasFile('printing_logo')) {
            $image2 = $request->file('printing_logo');
            $image_name2 = md5(rand(1000, 9999) . time()) . '.' . $image2->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image2->move($path1, $image_name2);
        } 

        if ($request->hasFile('report_card')) {
            $image3 = $request->file('report_card');
            $image_name3 = md5(rand(1000, 9999) . time()) . '.' . $image3->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image3->move($path1, $image_name3);
        } 

            $sch = new Branch;
           
            $sch->user_id           = $user->id;
            $sch->school_id         = $request->school;
            $sch->branch_name       = $request->branch_name;
            $sch->branch_head       = $request->branch_head;
            $sch->branch_address    = $request->branch_address;
            $sch->branch_pri_name   = $request->branch_pri_name;
            $sch->branch_phone_no   = $request->branch_phone_no;
            $sch->area_pin_code    = $request->area_pin_code;
            $sch->state            = $request->state;
            $sch->district         = $request->district;
            $sch->total_student    = $request->total_student;
            $sch->total_teacher    = $request->total_teacher;
            $sch->total_support_employee = $request->total_support_employee;
            $sch->currency = 'INR';
            $sch->system_logo = $image_name;
            $sch->text_logo = $image_name1;
            $sch->printing_logo = $image_name2;
            $sch->report_card = $image_name3;
             
            $sch->save();

        }
        //DB::
        // return $filename;
        return redirect()->route('branch-list')->with('success', 'Branch Created Successfully'); 
    }


    public function branchList(Request $request)
    {
        $search = $request->input('search');
        // Add logic to filter branches based on the search input
        $user = auth()->user();
        if ($user->role == GController::USER_ADMIN) {
            $branches = Branch::select('branch.*','users.email as user_email','school.name')
                        ->join('users', 'users.id', '=', 'branch.user_id')
                        ->join('school', 'school.id', '=', 'branch.school_id')
                        ->orderBy('branch.id', 'desc')
                        ->get();
        }
        else if ($user->role == GController::USER_SCHOOL) {
        $branches = Branch::select('branch.*','users.email as user_email','school.name')
            ->join('users', 'users.id', '=', 'branch.user_id')
            ->join('school', 'school.id', '=', 'branch.school_id')
            ->where('school.user_id', $user->id)
            ->orderBy('branch.id', 'desc')
            ->get();
        }


        return view('admin/branch/branch_list', compact('branches'));
    }// end function

    public function update(Request $request){
        
        $schoolData = DB::table('school')
                  ->select('id','name')
          ->orderBy('id', 'desc')
                  ->get();
        $schData = DB::table('branch')
                  ->select('*')
                  ->join('users','users.id','=','branch.user_id')
                  ->where(['branch.user_id' => $request->id ])
                  ->get()->first();
            return view('admin/branch/update_branch', ['branch' => $schData ,'school' => $schoolData]);
    }// end function

    public function updateBranch(Request $request){
        //dd($request->name);
        // $sch = new Branch;
        // $branch = Branch::find($request->id);

        if ($request->hasFile('system_logo')) {
            $image = $request->file('system_logo');
            $image_name = md5(rand(1000, 9999) . time()) . '.' . $image->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image->move($path1, $image_name);
        } 

        if ($request->hasFile('text_logo')) {
            $image1 = $request->file('text_logo');
            $image_name1 = md5(rand(1000, 9999) . time()) . '.' . $image1->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image1->move($path1, $image_name1);
        } 

        if ($request->hasFile('printing_logo')) {
            $image2 = $request->file('printing_logo');
            $image_name2 = md5(rand(1000, 9999) . time()) . '.' . $image2->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image2->move($path1, $image_name2);
        } 

        if ($request->hasFile('report_card')) {
            $image3 = $request->file('report_card');
            $image_name3 = md5(rand(1000, 9999) . time()) . '.' . $image3->getClientOriginalExtension();
            $path1 = public_path('/upload/branch_images');
            $image3->move($path1, $image_name3);
        }
            $data = [
                'branch_name' => $request->branch_name,
                'school_id' => $request->school_name,
                'branch_head' => $request->branch_head,
                'branch_address'=> $request->branch_address,
                'branch_pri_name' => $request->branch_pri_name,
                'branch_phone_no' => $request->branch_phone_no,
                'currency' => 'INR',
                'area_pin_code' => $request->area_pin_code,
			    'state' => $request->state,
                'district'  => $request->district,
				'total_student' => $request->total_student,
                'total_teacher' => $request->total_teacher,
                'total_support_employee' => $request->total_support_employee,
                'system_logo' => $image_name,
                'text_logo' => $image_name1,
                'printing_logo' => $image_name2,
                'report_card' => $image_name3,
                // 'test' => $request->test
            ];


            DB::table('branch')
            ->where('user_id', $request->user_id)
            ->update($data);


            return redirect()->route('branch-list')->with('success', 'Branch Information Updated Successfully');
    }// end function

    public function deleteBranch(Request $request, $user_id)
    {
        Branch::where('user_id', $user_id)->delete();
        User::where('id', '=', $user_id)->delete();

        // Redirect back with a success message
        return redirect('/branch-list')->with('success', 'Branch deleted successfully');
    }// end function

    public function status(Request $request, $id)
   {

       Branch::where('id', $id)->update(['status' => 0]);

    return redirect('/branch-list')->with('danger', 'Branch Status Inactive');

   }// end function

   public function inactiveStatus(Request $request, $id)
   {

       Branch::where('id', $id)->update(['status' => 1]);

    return redirect('/branch-list')->with('success', 'Branch Status Active');

   }// end function

   public function getBranches($schoolId) {
        $branches = Branch::where('school_id', $schoolId)->pluck('branch_name', 'id');

        return response()->json($branches);
    }

}
