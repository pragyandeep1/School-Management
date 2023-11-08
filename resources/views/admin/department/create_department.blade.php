@extends('layouts/layout')
@section('title', 'Create Department')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Department</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Department</h6>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('save-department') }}">
            @csrf
			<div class="d-flex">
                                <div class="row mb-3 col-md-6">
                                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
                                    <div class="col-md-12">
                                        <select name="school" id="school_id" class="form-control">
                                            <option value="">Select a School</option>
                                            @foreach ($school as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 col-md-6">
                                    <label for="branch" class="col-md-8 col-form-label text-md-end">Branch<i style="color:red;">*</i></label>
                                    <div class="col-md-12">
                                        <select name="select_branch" class="form-control">
                                            <option value="">Select a Branch</option>
                                           @foreach ($branch as $row)
                                                <option value="{{ $row->id }}">{{ $row->branch_name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
			<div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Department Name <i style="color:red;">*</i></label>
				<div class="col-md-6">
                    <input id="department_name" type="text" class="form-control" name="department_name" value="" required autocomplete="off" autofocus>
                </div>
            </div>
			
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end"></label>
				<div class="col-md-6">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
         </form>
    
    </div>
</div>
@endsection