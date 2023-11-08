@extends('layouts/layout')
@section('title', 'School List')
@section('content')
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">School</h1>
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{route('add-school')}}" class="btn btn-secondary right-0"><i class="fa fa-plus-circle"></i> Add School </a>
  </nav>
</div>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type: none;">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('danger'))
    <div class="alert alert-danger">
        <ul>
            <li style="list-style-type:none;">{!! \Session::get('danger') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
  
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">School List</h6>
    </div>

    <div class="card-body">
         <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>SchoolName</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>No of Students</th>
                                            <th>No of Teachers</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($schools as $key =>$row): ?>
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->user_email }}<br>{{ $row->phone_no }}</td>
                                            <td>{{ $row->address }}</td>
                                            <td>{{ $row->total_student }}</td>
                                            <td>{{ $row->total_teacher }}</td>
                                            <td>
                                              @if($row->status == 1)
                                              <form
                                               action="{{ url('update-status', ['id' => $row->id]) }}" method="POST">
                                               @csrf
                                               @method('PUT')
                                              <button type="submit" class="btn btn-success btn-xs"> Active </button>
                                              </form>
                                              @else
                                               <form
                                               action="{{ url('inactive-update-status', ['id' => $row->id]) }}" method="POST">
                                               @csrf
                                               @method('PUT')
                                              <button type="submit" class="btn btn-danger btn-xs"> Inactive </button>
                                              </form>
                                               @endif
                                            </td>
                                            <td class="d-flex">
                                                <a class="btn btn-info" href="{{ route('impersonate',$row->user_id) }}">
                                                  <i class="fas fa-sign-in-alt"></i>
                                                </a>
                                                <a class="btn btn-primary" href="{{ route('update-school') }}?id={{ $row->user_id }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('delete-school', ['user_id' => $row->user_id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>            
                                    </tbody>
                                </table>
        </div>
    </div>
</div>
@endsection