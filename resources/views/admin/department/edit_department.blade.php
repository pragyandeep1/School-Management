@extends('layouts/layout')
@section('title', 'Edit Department')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Department</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-8">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update Department</h6>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('update-department') }}">
            @csrf
			
         	<div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Branch<i style="color:red;">*</i></label>
				<div class="col-md-6">
                    <select name="select_branch" class="form-control">
					<?php 
					foreach($branch as $row):
					?>
						<option value="{{ $row->id }}" {{ $row->id==$department->branch_id ? 'selected' : '' }}>{{ $row->branch_name }}</option>
					<?php endforeach; ?>
					</select>
                </div>
            </div>
			<div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Department Name <i style="color:red;">*</i></label>
				<div class="col-md-6">
                    <input id="department_name" type="text" class="form-control" name="department_name" value="{{$department->department_name}}" required autocomplete="off" autofocus>
                </div>
            </div>
			
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end"></label>
				<div class="col-md-6">
					<input id="d_id" type="hidden" name="d_id" value="{{$department->id}}">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
         </form>
    
    </div>
</div>
@endsection