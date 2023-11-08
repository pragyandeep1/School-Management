@extends('layouts/layout')
@section('title', 'Edit Employee')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Employees</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update Employees</h6>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('update-employee') }}" enctype="multipart/form-data">
            @csrf
			
			<div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Pofile Picture <i style="color:red;">*</i></label>
				<div class="col-md-6">
					<input type="file" accept="image/*" class="form-control" name="emp_pic" id="emp_pic" value="" />
                </div> 
				<img class="img-responsive center" style="height: 35px; width: 35px;" src="@if($employee->emp_pic ){{ '/upload/employee_images'}}/{{ $employee->emp_pic }} @else {{ asset('images/avatar.svg')}} @endif" alt="">
            </div>
         	<div class="row mb-3">
                <label for="branch" class="col-md-4 col-form-label text-md-end">Select Branch Applying For<i style="color:red;">*</i></label>
				<div class="col-md-6">
                    <select name="branch_name" class="form-control">
					<option value="" selected="selected">Select Branch *</option>
					<?php 
					foreach($branch as $row):
					?>
						<option value="{{ $row->id }}" {{ $row->id==$employee->branch_id ? 'selected' : '' }}>{{ $row->branch_name }}</option>
					<?php endforeach; ?>
					</select>
                </div>
            </div>
			<div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name <i style="color:red;">*</i></label>
				<div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $employee->name }}" required autocomplete="off" autofocus>
                </div>
            </div>
			<div class="row mb-3">
                <label for="designation" class="col-md-4 col-form-label text-md-end">Designation <i style="color:red;">*</i></label>
				<div class="col-md-6">
                    <input id="designation" type="text" class="form-control" name="designation" value="{{ $employee->designation }}" required autocomplete="off" autofocus>
                </div>
            </div>
			<div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email <i style="color:red;">*</i></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $employee->email }}" required autocomplete="off" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
			<div class="row mb-3">
                <label for="Mobile No" class="col-md-4 col-form-label text-md-end">Mobile No <i style="color:red;">*</i></label>
				<div class="col-md-6">
                    <input id="mobile_no" type="text" class="form-control" name="mobile_no" value="{{ $employee->mobile_no }}" required autocomplete="off" autofocus>
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end"></label>
				<div class="col-md-6">
					 <input id="emp_id" type="hidden" class="form-control" name="emp_id" value="{{ $employee->id }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
         </form>
    </div>
</div>
@endsection