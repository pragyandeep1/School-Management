@extends('layouts/layout')
@section('title', 'Add Teacher')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Teacher</h1>
    <!-- Section header -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li class="active" style="list-style-type:none;">Add Teacher</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <div class="card shadow mb-4 col-lg-12">
        <div class="card-body">
            <form novalidate id="entryForm" action="{{route('create-teacher')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
                        <div class="col-md-12">
                            <select name="school" id="school_id" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
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
                <div class="d-flex">    
                    <div class="row mb-3 col-md-6">
                        <label for="name" class="col-md-8 col-form-label text-md-end">Name<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input autofocus type="text" class="form-control" name="teacher_name" placeholder="Enter Name" value="" required minlength="2" maxlength="255">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="designation" class="col-md-8 col-form-label text-md-end">Select Designation<span class="text-danger">*</span></label>
                        <div class="col-md-12">
    						<select name="designation" id="designation" class="form-control" required>
                                <option value="">Select</option>
        						@foreach($designation as $key=>$row)
        							<option value="{{ $key }}">{{ $row }}</option>
        						@endforeach
    						</select>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="qualification" class="col-md-8 col-form-label text-md-end">Qualification<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="qualification" placeholder="MA, BA, B. Sc" value="@if(isset($teacher)){{ $teacher->qualification }}@else{{old('qualification')}}@endif" maxlength="255" required>
                            <span class="text-danger">{{ $errors->first('qualification') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="dob" class="col-md-8 col-form-label text-md-end">Date of birth<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text" style="border: none; background-color: lightgray;">
                                        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                    </span>
                                </span>
                                <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" value="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required autocomplete="off" autofocus>
                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
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
                    <div class="row mb-3 col-md-6">
                        <label for="religion" class="col-md-8 col-form-label text-md-end">Select Religion
                            <span class="text-danger">*</span>                
                        </label>
                        <div class="col-md-12">
                            <select name="religion" id="religion" class="form-control">
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
                        <label for="phone_no" class="col-md-8 col-form-label text-md-end">Phone/Mobile No.<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text" style="border: none; background-color: lightgray;">
                                        <i class="fas fa-phone-volume"></i>
                                    </span>
                                </span>
                                <input id="phone" type="number" class="form-control" name="phone_no" maxlength="10" placeholder="phone or mobile number" required autocomplete="off" autofocus>
                                <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="email" class="col-md-8 col-form-label text-md-end">Email Id<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text" style="border: none; background-color: lightgray;">
                                        <i class="fas fa-envelope-open"></i>
                                    </span>
                                </span>
                                <input  type="email" class="form-control" name="email"  placeholder="email address" value="" maxlength="100" required autocomplete="off" autofocus>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="id_card" class="col-md-8 col-form-label text-md-end">ID Card No. / Employee ID<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input  type="text" class="form-control" name="id_card"  placeholder="id card number" value="" required minlength="4" maxlength="50">
                            <span class="text-danger">{{ $errors->first('id_card') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="joining_date" class="col-md-8 col-form-label text-md-end">Joining Date<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type='date' class="form-control"  name="joining_date" placeholder="date" value="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required minlength="10" maxlength="255" />
                            <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="photo" class="col-md-8 col-form-label text-md-end">Photo</label>
                        <div class="col-md-12">
                            <input  type="file" class="form-control" name="photo" alt="Photo image">            
                            <span class="glyphicon glyphicon-open-file form-control-feedback" style="top:45px;"></span>
                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="address" class="col-md-8 col-form-label text-md-end">Address</label>
                        <div class="col-md-12">
                            <textarea name="address" class="form-control"  maxlength="500" ></textarea>
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end"></label>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info pull-right"> Add </button>
                        <a href="" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->


   

    
