@extends('layouts.layout')
@section('title', 'Assign Subject')
@section('content')
    <div class="container">
        <h2>Add Assignment</h2>
        <form method="post" action="{{ route('assignments.store') }}">
            @csrf
            <div class="d-flex col-md-12" style="color: goldenrod">
                <div class="row mb-3 col-md-1 mt-1">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="row mb-3 col-md-3">
                    <h5>Assign</h5>
                </div>
                <hr class="row mb-3 col-md-8">
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="school" id="school_id" class="form-control">
                            <option value="">Select a School</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
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
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="class" class="col-md-8 col-form-label text-md-end">Class</label>
                    <div class="col-md-12">
                        <select class="form-control" id="class" name="class">
                            <option value="">Select</option>
                            <option value="Class A">Class A</option>
                            <option value="Class B">Class B</option>
                            <!-- Add more class options as needed -->
                        </select>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="section" class="col-md-8 col-form-label text-md-end">Section</label>
                    <div class="col-md-12">
                        <select class="form-control" id="section" name="section">
                            <option value="">Select</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-3 col-md-6">
                    <label for="subject" class="col-md-8 col-form-label text-md-end">Subject</label>
                    <div class="col-md-12 entry-wrapper" id="entryWrapper">
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                </div>
            <!-- <div id="subject-list"> -->
            <!-- The list of selected subjects will appear here -->
            <!-- </div> -->
            <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
