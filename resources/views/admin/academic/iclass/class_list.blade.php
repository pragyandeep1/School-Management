@extends('layouts/layout')
@section('title', 'Class List')
@section('content')
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Class</h1>
  @if(Auth::user()->role == 1)
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{ route('class_create') }}" class="btn btn-secondary right-0"><i class="fa fa-plus-circle"></i>Add Class</a>
  </nav>
  @endif
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
        <h6 class="m-0 font-weight-bold text-primary">Class List</h6>
    </div>
    <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
					<th width="5%">Sl</th>
                    <th width="20%">School</th>
					<th width="20%">Branch</th>
                    <!-- <th width="20%">Teacher</th> -->
					<th width="15%">Class</th>
                    @if(Auth::user()->role == 1)
					<th class="notexport" width="10%">Action</th>
                    @endif
				</tr>
                </thead>
                                    
                <tbody>
                     @foreach($classes as $iclass)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $iclass->school_name }}</td>
                        <td>{{ $iclass->branch_name }}</td>
                        {{--<td>{{ $iclass->teacher_name }}</td>--}}
                        <td>{{ $iclass->name }}</td>
                        @if(Auth::user()->role == 1)
                        <td>
                            <div class="btn-group">
                                <a title="Edit" href="{{URL::route('academic.class_edit',$iclass->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <form  class="myAction" method="POST" action="{{route('academic.class_destroy', ['id' => $iclass->id])}}">
                                    @csrf
                                    <input type="hidden" name="hiddenId" value="{{$iclass->id}}">
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
</div>
@endsection

<!-- BEGIN PAGE JS-->
@section('extraScript')
    <script type="text/javascript">
        $(document).ready(function () {
            window.postUrl = '{{URL::Route("academic.class_status", 0)}}';
            Academic.iclassInit();
        });
    </script>
@endsection
<!-- END PAGE JS-->