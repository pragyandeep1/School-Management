@extends('layouts/layout')
@section('title', 'User List')
@section('content')
<h1 class="h3 mb-4 text-gray-800">User Management</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type:none;">{!! \Session::get('success') !!}</li>
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
        <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($users as $key =>$row): ?>
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>
                                                @if($row->role == 1) Admin
                                                @elseif($row->role == 2) School
                                                @elseif($row->role == 3) Branch
                                                @elseif($row->role == 4) Teacher
                                                @elseif($row->role == 5) Student
                                                @endif
                                            </td>
                                            <td><?php echo $row->created_at; ?></td>
                                            <td>
                                               @if($row->status == 1)
                                              <form
                                               action="{{ url('active', ['id' => $row->id]) }}" method="POST">
                                               @csrf
                                               @method('PUT')
                                              <button type="submit" class="btn btn-success btn-xs"> Active </button>
                                              </form>
                                              @else
                                               <form
                                               action="{{ url('inactive', ['id' => $row->id]) }}" method="POST">
                                               @csrf
                                               @method('PUT')
                                              <button type="submit" class="btn btn-danger btn-xs"> Inactive </button>
                                              </form>
                                               @endif
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>    
                                    </tbody>
                                </table>
                            </div>
    </div>
</div>

 <!-- Page level plugins -->
 @endsection