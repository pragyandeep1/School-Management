@extends('layouts/layout')
@section('title', 'Section List')
@section('content') 
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Section List</h1>
  @if(Auth::user()->role == 1)
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{ route('academic.section_create') }}" class="btn btn-secondary right-0"><i class="fa fa-plus-circle"></i> Add Branch</a>
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
                                <th width="1%">Sl</th>
                                <th width="15%">Section Name</th>
                                <th width="15%">Capacity</th>
                                <th width="15%">Class</th>
                                <th width="15%">Teacher</th>
                                <th width="15%">Branch</th>
                                <th width="15%">School</th>
                                @if(Auth::user()->role == 1)
                                <th class="notexport" width="5%">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->capacity }}</td>
                                    <td>{{ $section->class_name }}</td>
                                    <td>{{ $section->teacher_name }}</td>
                                    <td>{{ $section->branch_name }}</td>
                                    <td>{{ $section->school_name }}</td>
                                    @if(Auth::user()->role == 1)
                                    <td class="d-flex">
                                        <div class="btn-group">
                                            <a title="Edit" href="{{route('academic.section_edit',$section->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                        <!-- todo: have problem in mobile device -->
                                        <div class="btn-group">
                                            <form  class="myAction" method="POST" action="{{route('academic.section_destroy')}}">
                                                @csrf
                                                <input type="hidden" name="hiddenId" value="{{$section->id}}">
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
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

<!-- END PAGE CONTENT-->
@endsection
<!-- BEGIN PAGE JS-->
@section('extraScript')
    <script type="text/javascript">
        $(document).ready(function () {
            window.postUrl = '{{URL::Route("academic.section_status", 0)}}';
            Academic.sectionInit();
        });
    </script>
@endsection
<!-- END PAGE JS-->
