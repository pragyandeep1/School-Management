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
		<table class="table table-bordered table-striped" id="student_table">
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
                            @foreach ($school as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
              
					</td>
					<td>
						<select name="select_branch" id="branch_id" class="form-control" required>
                            <option value="">Select</option>
                        </select>           
					</td>
					<td>
						<select name="select_class" id="class_id" class="form-control" required>
							<option value="" selected="selected">Select</option>
						</select>
					</td>
					<td>
						<select name="select_section" id="section_id" class="form-control" required>
							<option value="" selected="selected">Select</option>
						</select>
					</td>
          <td>
              <button type="button" name="search" id="search" class="btn btn-info btn-sm" data-toggle="modal" data-target="#attendanceModal">Search</button>
          </td>
				</tr>
			</tbody>
		</table>
	</div>	
</div>

<!-- The Modal -->
<div class="modal" id="attendanceModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold text-primary">Student Attendance</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="update-attendance-form" action="" method="post">
                <div class="d-flex col-md-12">
                <!-- Add teacher and date selection controls here -->
                    <select name="select_teacher" id="teacher_id" class="form-control col-md-6 mx-1">
                        <option selected="selected">Select Teacher</option>
                        <!-- Populate teacher options here -->
                    </select>

                    <input type="date" id="scheduledate" name="scheduledate" value="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="col-md-4" required>
                    <!-- <button type="button" class="btn btn-primary col-md-2 mx-1" id="fetch-student-details">Show</button> -->
                    <button type="button" id="show" data-teacher="{{ $teacher }}" class="btn btn-info col-md-2 mx-1">Show</button>
                </div>
            </form>
                <!-- Student details will be shown after selecting a teacher and date -->
                <div id="student-details" style="display: none;">
                    <div class="card shadow col-lg-12 student_att">
                        @if(count($results) > 0)
                            <form id="update-attendance-form" action="{{ url('update-present') }}" method="post">
                                @csrf
                                <ul class="d-flex">
                                    @foreach ($attendance as $row)
                                        <li class="mx-auto" style="list-style-type: none">
                                            <input type="checkbox" name="attendance[]" value="{{ $row->id }}" id="{{ $row->id }}">
                                            <strong>Student Name</strong> <br>{{ $attendance->name }}<br>
                                            <strong>Roll</strong> <br>{{ $attendance->roll_no }}<br>
                                        </li>
                                        @if($loop->iteration % 5 == 0)
                                            <ul class="d-flex flex-wrap"></ul>
                                        @endif
                                    @endforeach
                                </ul>
                                <button type="button" class="btn btn-secondary" id="update-attendance-button">Update</button>
                            </form>
                        @else
                            <h5 class="text-danger text-center">No Results Found</h5>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--   <div id="action_alert" title="Action">

  </div> -->

  <script>
document.getElementById("show").addEventListener("click", function() {
    var studentDetails = document.getElementById("student-details");
    if (studentDetails.style.display === "none" || studentDetails.style.display === "") {
        studentDetails.style.display = "block";
    } else {
        studentDetails.style.display = "none";
    }
});
</script>

@endsection