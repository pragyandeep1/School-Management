@extends('layouts/layout')
@section('title', 'Employee Register')
@section('content') 
<h1 class="h3 mb-4 text-gray-800 text-uppercase">Employee Form</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Employees</h6>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('save-emp') }}" enctype="multipart/form-data">
            @csrf
			<div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-school"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Academic Details</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School<span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select name="school" id="school_id" class="form-control" required>
                            <option value="">Select</option>
                             @foreach ($school as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="branch" class="col-md-8 col-form-label text-md-end">Select Branch<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="select_branch" class="form-control" required>
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="joining_date" class="col-md-8 col-form-label text-md-end">Joining Date <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input type='date' class="form-control"  name="joining_date" placeholder="date" value="" required minlength="10" maxlength="255" />
                        <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="branch" class="col-md-8 col-form-label text-md-end">Select Designation<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="designation_type" value="" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($designation_type as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="department" class="col-md-8 col-form-label text-md-end">Department <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="department" type="text" class="form-control" name="department" value="" placeholder="Enter Department" required autocomplete="off" autofocus>
                    </div>
                </div>
    			<div class="row mb-3 col-md-6">
                    <label for="qualification" class="col-md-8 col-form-label text-md-end">Qualification <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="qualification" type="text" class="form-control" name="qualification" value="" placeholder="Enter Qualification" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="experience_details" class="col-md-8 col-form-label text-md-end">Experience Details (in years) <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="experience_details" type="text" class="form-control" name="experience_details" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
    			<div class="row mb-3 col-md-6">
                    <label for="total_experience" class="col-md-8 col-form-label text-md-end">Total Experience (in years) <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="total_experience" type="text" class="form-control" name="total_experience" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Employee Details</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Name <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
    			<div class="row mb-3 col-md-6">
                    <label for="genger" class="col-md-8 col-form-label text-md-end">Gender <i style="color:red;">*</i></label>
    				<div class="col-md-12">
    					<select name="gender" id="gender" class="form-control" required>
                            <option selected="selected" value="">Select</option>    
                            @foreach($gender as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-4">
                    <label for="religion" class="col-md-8 col-form-label text-md-end">Select Religion <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="religion" id="religion" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($religion as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
    			<div class="col-md-4">
                    <label for="Blood" class="col-md-8 col-form-label text-md-end">Blood Group <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <select name="blood_group" id="blood_group" class="form-control" required>
                            <option value="">Select Blood Group</option>
                            @foreach($blood_group as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="dob" class="col-md-8 col-form-label text-md-end">Date of Birth <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                </span>
                            </span>
                            <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" value="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required autocomplete="off" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">  
    			<div class="row mb-3 col-md-6">
                    <label for="Mobile No" class="col-md-8 col-form-label text-md-end">Mobile No <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas fa-phone-volume"></i>
                                </span>
                            </span>
                            <input id="phone" type="text" class="form-control" name="mobile_no" value="" required autocomplete="off" autofocus>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="email" class="col-md-8 col-form-label text-md-end">Email <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas fa-envelope-open"></i>
                                </span>
                            </span>
                            <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Present Address <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <textarea id="present_address" class="form-control" name="present_address"></textarea>
                    </div>
                </div>
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Permanent Address <i style="color:red;">*</i></label>
    				<div class="col-md-12">
    					<textarea id="permanent_address" class="form-control" name="permanent_address"></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex">
    			<div class="row mb-3 col-md-12">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Pofile Picture <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <div class="file-input-container">
                            <label for="emp_pic" class="file-label">
                                <i class="fas fa-cloud-upload-alt"></i> 
                                Drag and drop a file here or click
                            </label>
    					    <input type="file" accept="image/*" class="form-control" name="emp_pic" id="emp_pic" value=""/>
                        </div>
                    </div>
                </div>
            </div>
    		<div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-user-lock"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Login Details</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
                <div class="col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">User Name<i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas fa-user"></i>
                                </span>
                            </span>
                            <input id="user_name" type="text" class="form-control" name="user_name" value="" required autocomplete="off" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Social Links</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
    			<div class="col-md-4">
    				<label for="name" class="col-md-8 col-form-label text-md-end">Facebook<i style="color:red;"></i></label>
    				<div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas-brands fa-facebook"></i>
                                </span>
                            </span>
                            <input id="facebook" type="text" class="form-control" name="facebook" placeholder="eg: https://www.facebook.com/username">
                        </div>
                    </div>
                </div>
    			<div class="row mb-3 col-md-4">
    				<label for="name" class="col-md-8 col-form-label text-md-end">Twitter<i style="color:red;"></i></label>
    				<div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas-brands fa-twitter"></i>
                                </span>
                            </span>
                            <input id="twitter" type="text" class="form-control" name="twitter" placeholder="eg: https://www.twitter.com/username" >
                        </div>
                    </div>
                </div>
                <div class="row mb-3 col-md-4">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Linkedin<i style="color:red;"></i></label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas-brands fa-linkedin"></i>
                                </span>
                            </span>
                            <input id="linkedin" type="text" class="form-control" name="linkedin" placeholder="eg: https://www.linkedin.com/username" >
                        </div>
                    </div>
                </div>
			</div>
            <div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-building"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Bank Details (Optional)</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Bank Name</label>
    				<div class="col-md-12">
                        <input id="bank_name" type="text" class="form-control" name="bank_name" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Holder Name</label>
                    <div class="col-md-12">
                        <input id="holder_name" type="text" class="form-control" name="holder_name" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Bank Branch</label>
    				<div class="col-md-12">
                        <input id="bank_branch" type="text" class="form-control" name="bank_branch" value="" autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Bank Address</label>
                    <div class="col-md-12">
                        <input id="bank_address" type="text" class="form-control" name="bank_address" value="" autocomplete="off" autofocus>
                    </div>
                </div>
	        </div>
            <div class="d-flex">
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">IFSC Code</label>
    				<div class="col-md-12">
                        <input id="ifsc" type="text" class="form-control" name="ifsc" value="" autocomplete="off" autofocus>
                    </div>
                </div>
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Account No</label>
    				<div class="col-md-12">
                        <input id="acc_no" type="text" class="form-control" name="acc_no" value="" autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
				<div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
         </form>
    </div>
</div>
@endsection