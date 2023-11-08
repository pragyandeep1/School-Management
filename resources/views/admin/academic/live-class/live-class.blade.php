@extends('layouts/layout')
@section('title', 'Live Class')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Live Class</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
    	<div class="d-flex col-md-12" style="color: goldenrod">
            <div class="row mb-3 col-md-1 mt-1">
                <i class="fas fa-edit"></i>
            </div>
            <div class="row mb-3 col-md-3">
                <h5>Add Live Class</h5>
            </div>
            <hr class="row mb-3 col-md-8">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form novalidate id="entryForm" action="{{ route('live-class') }}" method="post" enctype="multipart/form-data">
					<div class="box-body">
                        @csrf
						<div class="d-flex">
                                <div class="row mb-3 col-md-6">
                                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
                                    <div class="col-md-12">
                                        <select name="school" id="school_id" class="form-control">
                                            <option value="">Select a School</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 col-md-6">
                                    <label for="branch" class="col-md-8 col-form-label text-md-end">Branch<i style="color:red;">*</i></label>
                                    <div class="col-md-12">
                                        <select name="select_branch" id="branch_id" class="form-control">
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
    								<label for="branch" class="col-md-8 col-form-label text-md-end">Select your class<i style="color:red;">*</i></label>
    								<div class="col-md-12">
    									<select name="class_id" class="form-control">
    									<option value="" selected="selected">Choose your class *</option>
    									@foreach($class as $row)
    										<option value="{{ $row->id }}">{{ $row->name }}</option>
    									@endforeach
    									</select>
    								</div>
    							</div>
    							<div class="row mb-3 col-md-6">
    								<label for="branch" class="col-md-8 col-form-label text-md-end">Select section<i style="color:red;">*</i></label>
    								<div class="col-md-12">
    									<select name="section" class="form-control">
    									<option value="" selected="selected">Select section *</option>
    									@foreach($section as $row)
    										<option value="{{ $row->id }}">{{ $row->name }}</option>
    									@endforeach
    									</select>
    								</div>
    							</div>
    						</div>
						<div class="d-flex">
							<div class="row mb-3 col-md-6">
								<label for="teacher_id" class="col-md-8 col-form-label text-md-end">Teacher Name<i style="color:red;">*</i></label>
								<div class="col-md-12">
									<select name="teacher_id" id="teacher_id" class="form-control teacher">
										<option value="Select Teacher" selected="selected"></option>
									   @foreach($teacher as $row)
										<option value="{{ $row->id }}">{{ $row->name }}</option>
										@endforeach
									</select>
									<span class="text-danger">{{ $errors->first('teacher_id') }}</span>
								</div>
							</div>
							<div class="row mb-3 col-md-6">
	                           <label for="subject_id" class="col-md-8 col-form-label text-md-end">Subject</label>
	                           <div class="col-md-12">
	                               <select name="subject_id" id="subject_id" class="form-control select2s">
										<option value="" selected="selected">Select Subject</option>
									    @foreach($subject as $row)
										<option value="{{ $row->id }}">{{ $row->subject_name }}</option>
										@endforeach
									</select>
									<span class="text-danger">{{ $errors->first('subject_id') }}</span>
	                            </div>
                            </div>
						</div>
						<div class="d-flex">
							<div class="row mb-3 col-md-6">
								<label for="starttime" class="col-md-8 col-form-label text-md-end">Start Time<i style="color:red;">*</i></label>
								<div class="col-md-12">
									<input autofocus type="text" class="form-control timepicker" name="start_time" id="start_time" value="" required />
								</div>
							</div>
							<div class="row mb-3 col-md-6">
								<label for="endtime" class="col-md-8 col-form-label text-md-end">End Time<i style="color:red;">*</i></label>
								<div class="col-md-12">
									<input autofocus type="text" class="form-control timepicker" name="end_time" id="end_time" value="" required />
								</div>
							</div>
						</div>
						<div class="d-flex">
							<div class="row mb-3 col-md-6">
								<label for="classdate" class="col-md-8 col-form-label text-md-end">Date<i style="color:red;">*</i></label>
								<div class="col-md-12">
									<input autofocus type="date" class="form-control datepicker" name="class_date" id="class_date" value="" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />
								</div>
							</div>
							<div class="row mb-3 col-md-6">
								<label for="description" class="col-md-8 col-form-label text-md-end">Description<i style="color:red;"></i></label>
								<div class="col-md-12">
									<textarea class="form-control" name="description" id="description"></textarea>
								</div>
							</div>
						</div>
						<div class="row mb-3 col-md-6">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary send-mail">Create Online Class</button>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
<!-- BEGIN PAGE JS-->

@endsection

