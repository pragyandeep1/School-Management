@extends('layouts/layout')
@section('title', 'Attendance Form')
@section('content')
    <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Attendance</h1>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type: none;">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
	
	<div class="card shadow col-lg-12 search_student">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Student Attendance</h6>
    </div>
</div>

<div class="card shadow col-lg-12 student_att">
	<div class="table-responsive">
		<form method="GET" action="{{ route('attendance-list') }}" >
		@csrf
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th width="25%">Select School</th>
					<th width="25%">Select Branch</th>
					<th width="25%">Select Class</th>
					<th width="25%">Select Section</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<select name="school" id="school_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach ($school as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>              
					</td>
					<td>
						<select name="select_branch" id="branch_id" class="form-control">
                            <option value="">Select</option>
                        </select>           
					</td>
					<td>
						<select name="select_class" id="class_id" class="form-control">
							<option value="" selected="selected">Select</option>
						</select>
					</td>
					<td>
						<select name="select_section" id="section_id" class="form-control">
							<option value="" selected="selected">Select</option>
						</select>
					</td>
					<td><button type="submit" class="btn btn-primary">Search</button></td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>	

@endsection