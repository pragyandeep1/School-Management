@extends('layouts.layout')
@section('title', 'Edit Assignment')
@section('content')
    <div class="container">
        <h2>Edit Assignment</h2>
        <form method="post" action="{{ route('assignments.update', $assignment->id) }}">
            @csrf
            @method('PUT')
            <div class="row mb-3 col-md-6">
                <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
                <div class="col-md-12">
                    <select name="school" id="school_id" class="form-control">
                        <option value="">Select a School</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}" {{ $row->id==$liveResult->sch_id ? 'selected' : '' }}>{{ $school->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3 col-md-6">
                <label for="branch" class="col-md-8 col-form-label text-md-end">Branch<i style="color:red;">*</i></label>
                <div class="col-md-12">
                    <select name="select_branch" class="form-control">
                        <option value="">Select a Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <select class="form-control" id="class" name="class">
                    <option value="Class A" @if($assignment->class == 'Class A') selected @endif>Class A</option>
                    <option value="Class B" @if($assignment->class == 'Class B') selected @endif>Class B</option>
                    <!-- Add more class options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section</label>
                <select class="form-control" id="section" name="section">
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{ $assignment->subject }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Assignment</button>
        </form>
    </div>
@endsection
