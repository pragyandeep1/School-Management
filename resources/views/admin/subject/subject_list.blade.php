@extends('layouts/layout')
@section('title', 'Subject List')
@section('content')
<div class="d-flex col-lg-12">
    <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Subject</h1>
    @if(Auth::user()->role == 1)
      <nav class="page-breadcrumb right-0 col-md-2">
          <a href="{{route('add-subject')}}" class="btn btn-secondary right-0">Subject Form</a>
      </nav>
      @endif
</div>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type: none">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Subject List</h6>
    </div>
    <div class="card-body">
         <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <!-- <th>Branch Name</th> -->
                                            <th>Subject Name</th>
                                            <th>Subject Code</th>
                                            <th>Author</th>
                                            <th>Subject Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subject as $key=>$row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <!-- <td>{{ $row->branch_id }}</td> -->
                                            <td>{{ $row->subject_name }}</td>
                                            <td>{{ $row->subject_code }}</td>
                                            <td>{{ $row->subject_author }}</td>
                                            <td>{{ $row->subject_type }}</td>
                                            <td>
                                               <a class="button btn btn-info btn-sm" href="{{ route('edit_subject') }}/?id={{ $row->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
											   <a class="button btn btn-danger btn-sm" href="{{ route('subject-list.destroy', ['id' => $row->id]) }}">
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