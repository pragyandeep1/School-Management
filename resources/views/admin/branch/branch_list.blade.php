@extends('layouts/layout')
@section('title', 'Branch List')
@section('content')
<div class="d-flex col-lg-12">
  <h1 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Branch</h1>
  @if(Auth::user()->role == 1)
  <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{route('add-branch')}}" class="btn btn-secondary right-0"><i class="fa fa-plus-circle"></i> Add Branch </a>
  </nav>
  @endif
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Of Branch</h6>
    </div>
    <div class="card-body">
         <div class="table-responsive col-md-12">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Branch Name</th>
                        <th>School Name</th>
                        <th>Contact</th>
                        <th>Currency</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $key=>$row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->branch_name }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->user_email }}<br>{{ $row->branch_phone_no }}</td>
                        <td>{{ $row->currency ? $row->currency : 'N/A' }}</td>
                        <td>{{ $row->branch_address }}<br>{{ $row->district }}<br>{{ $row->state }}</td>
                        <td>
                            @if($row->status == 1)
                            <form action="{{ url('status', ['id' => $row->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-xs"> Active </button>
                                </form>
                                @else
                                <form action="{{ url('inactive-status', ['id' => $row->id]) }}" method="POST">
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
                                <a class="button btn btn-primary" href="{{ route('update-branch') }}?id={{ $row->user_id }}"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('delete-branch', ['user_id' => $row->user_id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection