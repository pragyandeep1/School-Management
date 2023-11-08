@extends('layouts/layout')
@section('title', isset($section) ? 'Edit Section':'Add Section')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Section</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="d-flex col-md-12" style="color: goldenrod">
            <div class="row mb-3 col-md-1 mt-1">
                <i class="fas fa-edit"></i>
            </div>
            <div class="row mb-3 col-md-3">
                @if($section)
                <h5>Update Section</h5>
                @else
                <h5>Create Section</h5>
                @endif
            </div>
            <hr class="row mb-3 col-md-8">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form novalidate id="entryForm" action="@if($section) {{URL::Route('academic.section_update', $section->id)}} @else {{URL::Route('academic.section_store')}} @endif" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            @csrf
                            <div class="d-flex">
                                <div class="row mb-3 col-md-6 has-feedback">
                                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School</label>
                                    <div class="col-md-12">
                                        <select name="school" id="school_id" class="form-control">
                                            <option value="" selected="selected">Select</option>
                                           @foreach($schools as $row)
                                            <option value="{{ $row->id }}" {{ (isset($section) && $row->id == $section->school_id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 col-md-6 has-feedback">
                                    <label for="class_id" class="col-md-8 col-form-label text-md-end">Select Branch</label>
                                    <div class="col-md-12">
                                        <select name="select_branch" id="branch_id" class="form-control">
                                            @if($section)
                                                <option value="" selected="selected">Select Branch</option>
                                                @foreach($branches as $row)
                                                <option value="{{ $row->id }}" {{ (isset($section) && $row->id == $section->branch_id) ? 'selected' : '' }}>{{ $row->branch_name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Select</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="row mb-3 col-md-6 has-feedback">
                                    <label for="teacher_id" class="col-md-8 col-form-label text-md-end">Select Teacher</label>
                                    <div class="col-md-12">
                                        <select name="select_teacher" id="teacher_id" class="form-control">
                                            @if($section)
                                                <option value="" selected="selected">Select</option>
                                                @foreach($teachers as $row)
                                                <option value="{{ $row->id }}" {{ (isset($section) && $row->id == $section->teacher_id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="" selected="selected">Select</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 col-md-6 has-feedback">
                                    <label for="class_id" class="col-md-8 col-form-label text-md-end">Class Name</label>
                                    <div class="col-md-12">
                                        <select name="select_class" id="class_id" class="form-control">
                                            @if($section)
                                                <option value="" selected="selected">Select</option>
                                                @foreach($classes as $row)
                                                <option value="{{ $row->id }}" {{ (isset($section) && $row->id == $section->class_id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="" selected="selected">Select</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="row mb-3 col-md-6">
                                    <label for="name" class="col-md-8 col-form-label text-md-end">Name<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <input autofocus type="text" class="form-control" name="name" placeholder="name" value="@if($section){{ $section->name }}@else{{ old('name') }} @endif" required minlength="1" maxlength="255">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3 col-md-6">
                                    <label for="capacity" class="col-md-8 col-form-label text-md-end">Capacity<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <input  type="number" class="form-control" name="capacity" placeholder="40" value="@if($section){{ $section->capacity }}@else{{ old('capacity') }}@endif" required min="1">
                                        <span class="text-danger">{{ $errors->first('capacity') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->
                        <div class="mx-5 box-footer">
                            <button type="submit" class="btn btn-info pull-right"><i class="fa @if($section) fa-refresh @else fa-plus-circle @endif"></i> @if($section) Update @else Add @endif</button>
                            <a href="{{URL::route('academic.section')}}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
    <script type="text/javascript">
        $(document).ready(function () {
            Academic.sectionInit();
        });
    </script>
@endsection
<!-- END PAGE JS-->
