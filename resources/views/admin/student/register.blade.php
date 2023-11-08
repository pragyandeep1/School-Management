@extends('layouts/layout')
@section('title', 'Register Student')
@section('content')
	<h1 class="h3 mb-4 text-gray-800 text-uppercase">Student Admission</h1>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
	<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Admissions Open For 2023-24</h6>
    </div>
    
    <div class="card-body">
         <form method="POST" action="{{route('save-student')}}" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
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
                        <select name="select_branch" id="branch_id" class="form-control" required>
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
            </div>
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
                    <label for="registration_no" class="col-md-8 control-label">Registration Number<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="registration_no" type="text" class="form-control" name="registration_no" placeholder="eg: 1234567" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="roll_no" class="col-md-8 control-label">Roll No</label>
                    <div class="col-md-12">
                        <input id="roll_no" type="number" class="form-control" name="roll_no" placeholder="eg: 12233445" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="date_of_join" class="col-md-8 col-form-label text-md-end">Admission Date<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="date" class="form-control" name="date_of_join" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="select_teacher" class="col-md-8 col-form-label text-md-end">Select Teacher<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="select_teacher" id="teacher_id" class="form-control" required>
                            <option value="" selected="selected">Select</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-4">
                    <label for="select_class" class="col-md-8 col-form-label text-md-end">Select class<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="select_class" id="class_id" class="form-control" required>
                            <option value="" selected="selected">Select</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="select_section" class="col-md-8 col-form-label text-md-end">Select Section<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="select_section" id="section_id" class="form-control" required>
                            <option value="" selected="selected">Select</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Select Category<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="category" id="ddClass" class="form-control" required>
                            <option selected="selected" value="">Select</option>
                            <option value="sc">Scheduled Caste</option>
                            <option value="st">Scheduled Tribe</option>
                            <option value="obc">Other Backward Caste</option>
                            <option value="ur">Unreserved</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Student Details</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Student Name
                        <i style="color:red;">*</i>
                    </label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                    <span class="input-group-text" style="border: none; background-color: lightgray;">
                                        <i class="fas fa-user-graduate" style="height: 100%;"></i>
                                    </span>
                                </span>
                            <input id="student_id" type="text" class="form-control" name="name" value="" required autocomplete="off" autofocus>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <strong class="text-danger">{{ $error }}</strong>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="gender" class="col-md-8 col-form-label text-md-end">Select Gender<span class="text-danger">*</span></label>
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
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Blood Group</label>
                    <div class="col-md-12">
                        <select name="blood_group" id="blood_group" class="form-control">
                            <option value="">Select</option>
                            @foreach($blood_group as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
                            @endforeach
                        </select>                   
                        <span class="text-danger">{{ $errors->first('blood_group') }}</span>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Date of Birth <i style="color:red;">*</i></label>
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
                    <label for="language" class="col-md-8 control-label">Mother Tongue<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="language" type="text" class="form-control" name="language" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="religion" class="col-md-8 col-form-label text-md-end">Select Religion
                        <span class="text-danger">*</span>                
                        </label>
                    <div class="col-md-12">
                        <select name="religion" id="religion" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($religion as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
                            @endforeach
                        </select>                   
                        <span class="text-danger">{{ $errors->first('religion') }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Mobile No <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas fa-phone-volume"></i>
                                </span>
                            </span>
                            <input id="phone" type="number" class="form-control" name="phone_no" maxlength="10" placeholder="eg: 9876543210" required autocomplete="off" autofocus>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Student Email<i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas fa-envelope-open"></i>
                                </span>
                            </span>
                            <input  type="email" class="form-control" name="email"  placeholder="email address" value="" required maxlength="100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">City <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="city" placeholder="Enter city" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Select State<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="state" id="stateId" class="form-control select-arrow-cust widget_input" required>
                            <option value="">Select</option>
                            @foreach($state as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
                            @endforeach
                        </select>                   
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Present Address<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <textarea class="form-control" name="curr_add" id="curr_add" required></textarea>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Permanent Address<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <textarea class="form-control" name="permanent_add" id="permanent_add" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end">Student Photo<i style="color:red;">*</i></label>
                <div class="col-md-12">
                    <div class="file-input-container">
                        <label for="student_pic" class="file-label">
                            <i class="fas fa-cloud-upload-alt"></i> 
                            Drag and drop a file here or click
                        </label>
                        <input id="student_pic" type="file" class="form-control" name="student_pic" value="" autocomplete="off" autofocus required>
                    </div>
                </div>
            </div>
            <div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-users"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Guardian Details</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Father's Name <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="father" value="" placeholder="Enter Father's name" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Mother's Name <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="mother" value="" placeholder="Enter Mother's name" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Guardian Name <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="guardian_name" value="" placeholder="Enter Guardian's name" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Relation with Candidate <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="relation" value="" placeholder="eg: Father" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="occupation" class="col-md-8 control-label">Occupation<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="occupation" type="text" class="form-control" name="occupation" placeholder="eg: Software Engineer" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="income" class="col-md-8 control-label">Annual Income<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="income" type="number" class="form-control" name="income" placeholder="eg: 100000" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Guardian Contact No <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas fa-phone-volume"></i>
                                </span>
                            </span>
                            <input id="phone1" type="number" class="form-control" name="guardian_phone" maxlength="10" placeholder="eg: 9876543210" required autocomplete="off" autofocus>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Guardian Email Id <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text" style="border: none; background-color: lightgray;">
                                    <i class="fas fa-envelope-open"></i>
                                </span>
                            </span>
                            <input id="name" type="text" class="form-control" name="guardian_email" value="{{ old('email') }}" placeholder="eg: xyz@gmail.com" required autocomplete="off" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
             <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
				<div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>

         </form>
    
    </div>
</div>

@endsection