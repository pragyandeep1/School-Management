@extends('layouts/layout')
@section('title', 'Add Subject')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-uppercase">Subject</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type:none">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Subject Add</h6>
    </div>
    <div class="card-body">
         <form method="GET" action="{{ route('save-subject') }}">
            @csrf
			
         	<div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="school" id="school_id" class="form-control">
                            <option value="">Select</option>
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
			<div class="d-flex">
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Subject Name <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="subject_name" type="text" class="form-control" name="subject_name" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Subject Code <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="subject_code" type="text" class="form-control" name="subject_code" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end"> Author <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="subject_author" type="text" class="form-control" name="subject_author" value="" required autocomplete="off" autofocus>
                    </div>
                </div>	
    			<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Subject Type <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="subject_type" type="text" class="form-control" name="subject_type" value="" required autocomplete="off" autofocus>
                    </div>
                </div>
			</div>
            <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
				<div class="col-md-12">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
         </form>
    
    </div>
</div>
@endsection