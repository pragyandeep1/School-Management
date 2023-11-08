@extends('layouts/layout')
@section('title', 'Edit Student')
@section('content')
	<h1 class="h3 mb-4 text-gray-800">Student</h1>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
	<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update Student</h6>
    </div>
    
    <div class="card-body">
         <form method="POST" action="{{ route('update-student') }}" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
             	<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Name <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input type="text" class="form-control" name="name" value="{{ $student->name ?? 'Name not found' }}" autocomplete="off" autofocus>
                    </div>
                </div>
    			
    			<div class="row mb-3 col-md-6">
                    <label for="school" class="col-md-8 col-form-label text-md-end">Update School<i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <select name="school" class="form-control select2-multiple-school" required>
    					<option value="" selected="selected">Select</option>
    					@foreach($school as $row)
    						<option value="{{ $row->id }}" {{ $student && $row->id == $student->school_id ? 'selected' : '' }}>{{ $row->name }}</option>
    					@endforeach
    					</select>
                    </div>
                </div>
            </div>
            <div class="d-flex">
    			<div class="row mb-3 col-md-6">
                    <label for="branch" class="col-md-8 col-form-label text-md-end">Update Branch<i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <select name="select_branch" class="form-control select2-multiple-branch">
    					<option value="" selected="selected">Select</option>
    					@foreach($branch as $row)
    						<option value="{{ $row->id }}" {{ $student && $row->id == $student->branch_id ? 'selected' : '' }}>{{ $row->branch_name }}</option>
    					@endforeach
    					</select>
                    </div>
                </div>
    			<div class="row mb-3 col-md-6">
                    <label for="branch" class="col-md-8 col-form-label text-md-end">Update Class<i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <select name="select_class" class="form-control">
    					<option value="" selected="selected">Select</option>
    					
                        @foreach ($class as $row)
                            <option value="{{ $row->id }}" {{ $student && $row->id == $student->class_id ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
    					</select>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="section_id" class="col-md-8 col-form-label text-md-end">Update Section<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="select_section" class="form-control">
                        <option value="" selected="selected">Select</option>
                        
                        @foreach ($section as $row)
                                <option value="{{ $row->id }}" {{ $student && $row->id == $student->section_id ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="teacher_id" class="col-md-8 col-form-label text-md-end">Upadate Teacher<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="select_teacher" class="form-control">
                        <option value="" selected="selected">Select</option>
                        @foreach($teacher as $row)
                            <option value="{{ $row->id }}" {{ $student && $row->id == $student->teacher_id ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Date of Birth <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="date_of_birth" type="date" class="form-control" name="date_of_brith" value="{{ $student ? $student->date_of_birth : '' }}" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Current Address<i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <textarea class="form-control" name="curr_add" id="curr_add">{{ $student ? $student->curr_add : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Permanent Address<i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <textarea class="form-control" name="permanent_add" id="permanent_add">{{ $student ? $student->permanent_add : '' }}</textarea>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Guardian Name <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="" type="text" class="form-control" name="guardian_name" value="{{ $student ? $student->guardian_name : '' }}" required autocomplete="off" autofocus>
                    </div>
                </div>
			</div>
            <div class="d-flex">
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Relation with Guardian <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="" type="text" class="form-control" name="relation_with_guardian" value="{{ $student ? $student->relation : '' }}" required autocomplete="off" autofocus>
                    </div>
                </div>
    			
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Mobile No <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="" type="text" class="form-control" name="phone_no" value="{{ $student ? $student->phone_no : '' }}" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="guardian_phone" class="col-md-8 col-form-label text-md-end">Secondary contact No <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input type="text" class="form-control" name="secondary_phone_no" value="{{ $student ? $student->guardian_phone : '' }}" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Blood Group</label>
                    <div class="col-md-12">
                        <select name="blood_group" id="blood_group" class="form-control">
                            <option value="">Select</option>
                            @foreach($blood_group as $key=>$row)
                                <option value="{{ $key }}" {{ $student && $row->id == $student->blood_group ? 'selected' : '' }}>{{ $row }}</option>
                            @endforeach
                        </select>                   
                        <span class="text-danger">{{ $errors->first('blood_group') }}</span>
                    </div>
                </div>
            </div>
            <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end">Update Student Photo<i style="color:red;">*</i></label>
                <div class="col-md-12">
                    <input id="student_pic" type="file" class="form-control" name="student_pic" value="" autocomplete="off" autofocus required>
                </div>
                @if($student && $student->student_pic)
                        <div class="col-md-12">
                            <img src="{{ asset('upload/student_images/'.$student->student_pic) }}" alt="student_pic" height="120" width="200">
                        </div>
                    @endif
            </div>
            @php
                $image_name = ''; 
            @endphp

             <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
				<div class="col-md-12">
                    @if($student)
					<input id="student_id" type="hidden" class="form-control" name="student_id" value="{{ $student->id }}">
                    @endif
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
         </form>
    
    </div>
</div>


@endsection