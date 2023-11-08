@extends('layouts/layout')
@section('title', 'Attendance List')
@section('content')
<div class="d-flex col-lg-12">
    <h1 class="h3 mb-4 text-gray-800 col-md-10">Student Attendance</h1>

    @if(Auth::user()->role == 1)
    <nav class="page-breadcrumb right-0 col-md-2">
        <button class="btn btn-secondary right-0" data-status="1" id="update-attendance-button">Update</button>
    </nav>
    @endif
</div>
@if (\Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li style="list-style-type: none;">{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif

<div class="d-flex card shadow col-lg-12">
    <div class="d-flex d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary col-md-6">Student Attendance Summary</h6>
        <select name="select_teacher" id="teacher_id" class="form-control col-md-4 mx-1">
            <option selected="selected">Select Teacher</option>
            <?php foreach ($results as $row): ?>
                <?php $selected = ($row->teacher_id == $row->teacher_name) ? 'selected' : ''; ?>
                <option value="{{ $row->teacher_id }}" {{ $selected }}>{{ $row->teacher_name }}</option>
            <?php endforeach; ?>
        </select>

        <input type="date" class="col-md-2" id="scheduledate" name="scheduledate" value="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
    </div>
</div>

<div class="card shadow col-lg-12 student_att">
    <div>
        @if(count($results) > 0)
            <form id="update-attendance-form" action="{{ url('update-present', ['id' => $row->id]) }}" method="post">
                @csrf
                <ul class="d-flex">
                    @foreach ($results as $row)
                        <li class="mx-auto" style="list-style-type: none">
                            <input type="checkbox" name="attendance[]" value="{{ $row->id }}" id="student_{{ $row->id }}">
                            <strong>Student Name</strong> <br>{{ $row->name }}<br>
                            <strong>Roll</strong> <br>{{ $row->roll_no }}<br>

                        </li>
                        @if($loop->iteration % 5 == 0)
                            </ul>
                            <ul class="d-flex flex-wrap">
                        @endif

                    @endforeach
                </ul>
                {{--@if($row->status == 1)
                            <form action="{{ url('update-present') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-secondary btn-xs" style="position: absolute; top: 0; right: 0"> Present </button>
                            </form>
                        @else
                            <form action="{{ url('update-absent', ['id' => $row->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-xs" style="position: absolute; top: 0; right: 0"> Absent </button>
                            </form>
                        @endif--}}
            </form>
        @else
        <h5 class="text-danger text-center">No Results Found</h5>
        @endif
    </div>
</div>
@endsection