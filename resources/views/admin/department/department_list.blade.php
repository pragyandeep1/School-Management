@extends('layouts/layout')
@section('title', 'Department List')
@section('content')
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Department List</h1>
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{route('create-department')}}" class="btn btn-secondary right-0">Add Department</a>
  </nav>
</div>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type:none">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Department List</h6>
    </div>
    <div class="card-body">
         <div class="table-responsive col-md-12">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Sl</th>
						<th>Branch Name</th>
						<th>Department Name</th>
						<th>Action</th>
					</tr>
				</thead>
				
				<tbody>
					@foreach($department as $key =>$row)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $row->branch_name }}</td>
						<td>{{ $row->department_name }}</td>
						<td>
							<a class="button btn btn-info btn-sm" href="{{ route('edit_department') }}/?id={{ $row->id }}">
								<i class="fas fa-edit"></i>
							</a> 
							<a class="button btn btn-danger btn-sm" href="{{ route('department-list.destroy', ['id' => $row->id]) }}">
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