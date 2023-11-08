@extends('layouts/layout')
@section('title', 'Student List')
@section('content')
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Students</h1>
  @if(Auth::user()->role == 1)
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{route('create-admission')}}" class="btn btn-secondary right-0">Register Student</a>
  </nav>
  @endif
</div>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type: none;">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('danger'))
    <div class="alert alert-danger">
        <ul>
            <li style="list-style-type:none;">{!! \Session::get('danger') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Students</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
			<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Sl</th>
						<th>Image</th>
						<th>Name</th>
						<th>Role No</th>
						<th>Guardian Name</th>
						<th>Class</th>
						<th>Section</th>
						<th>Contact No</th>
						<th>Date of Join</th>
						@if(Auth::user()->role == 1)
						<th>Action</th>
						@endif
					</tr>
				</thead>
				
				<tbody>
					@foreach($student as $key=>$row)
						<tr>
							<td>{{ $key+1 }}</td>
							<td><img class="img-responsive center" style="height: 35px; width: 35px;" src="@if($row->student_pic ){{ 'upload/student_images'}}/{{ $row->student_pic }} @else
						        @if($row->gender == 'Male')
						            {{ asset('images/avatar_male.svg') }}
						        @else
						            {{ asset('images/avatar_female.svg') }}
						        @endif
						    @endif" alt=""></td>
							<td>{{ $row->name }}</td>
							<td>{{ $row->roll_no }}</td>
							<td>{{ $row->guardian_name }}</td>
							<td>
							    @if($row->iClass) 
							        {{ $row->iClass->name }}
							    @else
							        N/A
							    @endif
							</td>
							<td>
							    @if($row->section)
							        {{ $row->section->name }}
							    @else
							        N/A
							    @endif
							</td>

							<td>{{ $row->phone_no }}</td>
							<td>{{ $row->date_of_join }}</td>
							@if(Auth::user()->role == 1)
							
							<td class="d-flex">
                                <a class="btn btn-primary" href="{{ route('edit_student') }}?id={{ $row->id }}"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('delete-student', ['id' => $row->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
    </div>
</div>

 <!-- Page level plugins -->
 @endsection