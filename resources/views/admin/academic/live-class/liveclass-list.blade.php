@extends('layouts/layout')
@section('title', 'Upcoming Live Class List')
@section('content') 
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type:none">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <h2>Upcoming Live Class List</h2>
            </div>
            @if(Auth::user()->role == 1)
            <div class="col-md-6 text-right">
                <a class="btn btn-secondary right-0" href="{{ URL::route('live-class') }}"><i class="fa fa-plus-circle"></i> Live Class</a>
            </div>
            @endif
        </div>
                    
        <!-- /.box-header -->
        <div class="box-body margin-top-20">
            <div class="table-responsive">
                <table  class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th width="1%">Sl</th>
                        <th width="15%">School, Branch</th>
                        <th width="15%">Class, Section</th>
                        <th width="10%">Teacher, Subject</th>
								
						<!-- <th width="15%">Meeting Password</th> -->
						<th width="14%">Date</th>
						<th width="14%">Start</th>
						<th width="14%">End</th>
                        <!-- <th width="10%">Status</th> -->
                        <th width="15%">Join Link</th>
                        @if(Auth::user()->role == 1)
                        <th class="notexport" width="18%">Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($liveclass as $liveClassRes)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>{{ $liveClassRes->school_name }},<br>{{ $liveClassRes->branch_name }}</td>
                            <td>{{ $liveClassRes->class_name }}, {{ $liveClassRes->section_name }}</td>
							<td>{{ $liveClassRes->teacher_name }},<br>{{ $liveClassRes->subject_name }}</td>
							<td>{{ date('d/m/Y', strtotime($liveClassRes->class_date)) }}</td>
							<td>{{ $liveClassRes->start_time }}</td>
                            <td>{{ $liveClassRes->end_time }}</td>
                            <td>
                                <a class="btn btn-success btn-md text-decoration-none" href="https://meet.jit.si/{{ $liveClassRes->meeting_id }}" target="_blank">Link</a>
                            </td>
                            @if(Auth::user()->role == 1)
                            <td class="d-flex">
                                <div class="btn-group">
                                    <a title="Edit" href="{{ route('edit-live-class',$liveClassRes->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <!-- todo: have problem in mobile device -->
                                <div class="btn-group">
                                    <form  class="myAction" method="POST" action="{{ route('liveclass-delete', ['id' => $liveClassRes->id]) }}">
                                        @csrf
										<input type="hidden" name="d_id" value="{{$liveClassRes->id}}" />
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
		</div>
    </section>
<!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

