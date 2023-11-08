@extends('layouts/layout')
@section('title', 'Teacher List')
@section('content')
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Teacher List</h1>
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{ URL::route('add-teacher') }}" class="btn btn-secondary right-0">Add Teacher</a>
  </nav>
</div>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type:none;">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    
                    <!-- /.box-header -->
                    <div class="box-body margin-top-20">
                        <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">Sl</th>
                                <th class="notexport" width="10%">Photo</th>
                                <th width="18%">ID Card</th>
                                <th width="24%">Name</th>
                                <th width="18%">Phone No</th>
                                <th width="15%">Email</th>
                                <th width="10%">School<br>Branch</th>
                                <th class="notexport" width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <img class="img-responsive center" style="height: 35px; width: 35px;" src="@if($teacher->photo){{ asset('upload/teacher/')}}/{{ $teacher->photo }} @else
                                @if($teacher->gender == 1)
                                    {{ asset('images/avatar_male.svg') }}
                                @else
                                    {{ asset('images/avatar_female.svg') }}
                                @endif @endif" alt="photo">
                                    </td>
                                    <td>{{ $teacher->id_card }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->phone_no }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ optional($teacher->branch)->school->name ?? 'School not found' }}<br>
    {{ optional($teacher->branch)->branch_name ?? 'Branch not found' }}</td>
                                    <td class="d-flex">
                                        <div class="btn-group col-md-3">
                                            <a title="Edit" href="{{URL::route('edit-teacher','id='.$teacher->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                        <!-- todo: have problem in mobile device -->
                                        <div class="btn-group col-md-3">
                                            <form  class="myAction" method="POST" action="{{route('destroy-teacher', 'id='.$teacher->id)}}">
                                                @csrf
												<input type="hidden" name="d_id" value="{{$teacher->id}}" />
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Teacher Details</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			  <div class="modal-body">
				<p><strong>ID:</strong> <span id="user-id"></span></p>
				<p><strong>Name:</strong> <span id="user-name"></span></p>
				<p><strong>Email:</strong> <span id="user-email"></span></p>
				<img class="img-responsive center teacher-img" style="height: 200px; width: 200px;" src="" alt="">
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
    </section>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

