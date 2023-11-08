<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\School;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\GController;
use DB;

class EmployeeController extends Controller
{
    public function addEmployee(){
        return view('admin/employee/new-employee');
    }
	public function fetchEmployee(){
		
        $religion = GController::RELIGION;
        $designation_type = GController::EMPLOYEE_DESIGNATION_TYPES;
        $blood_group = GController::BLOOD_GROUP;
        $gender = GController::GENDER;
        $schData = DB::table('school')
                  ->select('id','name')
                  ->orderBy('name', 'ASC')
                  ->get();
		$brData = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('branch_name', 'ASC')
                  ->get();
		 return view('admin/employee/new-employee', [ 'school' => $schData, 'branch' => $brData, 'religion' => $religion, 'designation_type' => $designation_type, 'blood_group' => $blood_group, 'gender' => $gender ]);
    }
    public function save(Request $request){
		
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class] 
        ]);

        Employee::create($validatedData);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'   => 2,
        ]);

		if($request->hasFile('emp_pic')) {
            $storagepath = $request->file('emp_pic')->store('/upload/employee_images');
            $fileName = basename($storagepath);
            $data['photo'] = $fileName;
        }

        if(!empty($user->id)){
			
            $sch = new Employee;
           
            $sch->user_id      		= $user->id;
			$sch->branch_id      	=$request->branch_name;
			$sch->joining_date      	=$request->joining_date;
            $sch->designation    = $request->designation;
            $sch->department   = $request->department;
            $sch->qualification   = $request->qualification;
            $sch->experience_details    = $request->experience_details;
			$sch->total_experience            = $request->total_experience;
            $sch->name         = $request->name;
			$sch->gender    = $request->gender;
            $sch->religion    = $request->religion;
            $sch->blood_group = $request->blood_group;
			 //echo '<pre>'; print_r($sch); exit;
			 
			 $sch->dob = $request->dob;
			 $sch->mobile_no = $request->mobile_no;
			 $sch->email = $request->email;
			 $sch->present_address = $request->present_address;
			 $sch->permanent_address = $request->permanent_address;
			 
			 $sch->emp_pic = $data['photo'];
			 $sch->user_name = $request->user_name;
			 $sch->password = $request->password;
			 $sch->retype_password = $request->retype_password;
			 $sch->facebook = $request->facebook;
			 $sch->twitter = $request->twitter;
			 $sch->linkedin = $request->linkedin;
			 $sch->bank_name = $request->bank_name;
			 
			 $sch->holder_name = $request->holder_name;
			 $sch->bank_branch = $request->bank_branch;
			 $sch->ifsc = $request->ifsc;
			 $sch->acc_no = $request->acc_no;
			$sch->save();

        }
        //DB::

        return redirect('/employees')->with('success', 'New Employee Successful Registered'); 
    }

    public function employeeList(){

		$schData = DB::table('employee')
                  ->select('employee.*', 'branch.branch_name')
                ->join('branch', 'employee.branch_id', '=', 'branch.id')
                ->orderBy('employee.id', 'DESC')
                ->get();
       return view('admin/employee/employee_list', [ 'employee' => $schData ]); 
    }

    public function editEmployee(Request $request){
        //dd($schData);
		$schData = DB::table('employee')
                  ->select('*')
                  ->where(['id' => $request->id ])
                  ->get()->first();
       // dd($schData);
		$schDataBranch = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'DESC')
                  ->get();

        return view('admin/employee/edit_employee', [ 'employee' => $schData, 'branch' => $schDataBranch ]); 

    }

    public function updateEmployee(Request $request){
        //dd($request->name);
        $sch = new Employee;
		if($request->hasFile('emp_pic')) {
            $storagepath = $request->file('emp_pic')->store('/upload/employee_images');
            $fileName = basename($storagepath);
            $data['photo'] = $fileName;
        }
            $data = [
                'emp_pic' => $data['photo'],
				'branch_id'=> $request->branch_name,
                'name'=> $request->name,
                'designation' => $request->designation,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no
            ];

			
            DB::table('employee')
            ->where('id', $request->emp_id)
            ->update($data);


            return redirect()->back()->with('success', 'Updated Employee Details Successfully');
    }
	
	public function destroy(Request $request){
		//dd($request->id);
		DB::table('employee')->where('id', $request->id)->delete();
       
        return redirect()->back()->with('success', 'Removed Employee Details Successful'); 
    }
}
