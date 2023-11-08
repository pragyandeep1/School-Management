@extends('layouts/layout')
@section('title', 'Employee List')
@section('content')
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Employee List</h1>
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{route('new-employee')}}" class="btn btn-secondary right-0">Employee Form</a>
  </nav>
</div>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Of Employee</h6>
    </div>
    <div class="card-body">
         <div class="table-responsive col-md-12">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl</th>
						<th>Pofile Picture</th>
                        <th>Branch Name</th>
						<th>Staff id</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                                    
                <tbody>
                    @foreach($employee as $key=> $row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img class="img-responsive center" style="height: 35px; width: 35px;" src="@if($row->emp_pic ){{asset('upload/employee')}}/{{ $row->emp_pic }}@else {{ asset('images/avatar.jpg')}} @endif" alt=""></td>
						<td>{{ $row->branch_name }}</td>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->designation }}</td>
                        <td>{{ $row->department }}</td>
                        <td>{{ $row->email }}<br>{{ $row->mobile_no }}</td>
                        <td class="col-md-2">
							<a class="button btn btn-info btn-sm" href="{{ route('edit_employee') }}/?id={{ $row->id }}">
                                <i class="fas fa-edit"></i>
                            </a>
							<a class="button btn btn-danger btn-sm" href="{{ route('employee-list.destroy', ['id' => $row->id]) }}">
                                <i class="fas fa-trash"></i>
                            </a>
						</td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection