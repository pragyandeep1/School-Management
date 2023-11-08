<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\School;
use App\Models\Branch;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class DepartmentController extends Controller
{
	
    public function employeeDepartment(){
        return view('admin/department/create_department');
    }

	public function fetchBranch(){
		$school = School::all();
		$schData = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'DESC')
                  ->get();
		 return view('admin/department/create_department', [ 'branch' => $schData, 'school' => $school ]);
    }
	
	
    public function save(Request $request){
	
        if(!empty($request->select_branch) && !empty($request->department_name)){
            $schools = School::all();

            $sch = new Department;
         
			DB::table('department')->insert(
				array(
					'branch_id'  =>   $request->select_branch,
					'department_name'   	=>   $request->department_name,
				)
			);
			
        }

        return redirect()->route('department-list')->with('success', 'Department created successfully'); 
    }

    public function departmentList(){

       $schData = DB::table('department')
        ->select('department.id', 'branch.branch_name', 'department.department_name')
        ->leftJoin('branch', 'department.branch_id', '=', 'branch.id')
        ->orderBy('department.id', 'DESC')
        ->get();

       return view('admin/department/department_list', [ 'department' => $schData ]); 
    }

	
	public function editDepartment(Request $request){
        
        $schData = DB::table('department')
                  ->select('*')
                  ->where(['id' => $request->id ])
                  ->get()->first();
       // dd($schData);
	   $schDataBranch = DB::table('branch')
                  ->select('id','branch_name')
				  ->orderBy('id', 'DESC')
                  ->get();

        return view('admin/department/edit_department', [ 'department' => $schData, 'branch' => $schDataBranch ]);
    }
	
    public function updateDepartment(Request $request){
        
        $sch = new Department;
         
		$data = [
			'branch_id'  =>   $request->select_branch,
			'department_name'   	=>   $request->department_name,
		];


		DB::table('department')
		->where('id', $request->d_id)
		->update($data);

		return redirect()->back()->with('success', 'Successful updated Department.');
    }
	public function destroy(Request $request){
		//dd($request->id);
		DB::table('department')->where('id', $request->id)->delete();
       
        return redirect()->back()->with('success', 'Department deleted Successful'); 
    }
}
