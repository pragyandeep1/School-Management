@extends('layouts/layout')
@section('title', 'Add Class')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Class</h1>
    <!-- ./Section header -->
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <!-- Main content -->
    <section class="content">
        <div class="d-flex col-md-12" style="color: goldenrod">
            <div class="row mb-3 col-md-1 mt-1">
                <i class="fas fa-edit"></i>
            </div>
            <div class="row mb-3 col-md-3">
                <h5>Create Class</h5>
            </div>
            <hr class="row mb-3 col-md-8">
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form novalidate id="entryForm" action="{{route('class_store')}}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            @csrf
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
                                        <select name="select_branch" id="branch_id" class="form-control">
                                            <option value="">Select a Branch</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                 
                            <div class="d-flex">
                                <!-- <div class="row mb-3 col-md-6">
                                    <label for="name" class="col-md-8 col-form-label text-md-end">Teacher Name<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <select name="select_teacher" id="teacher_id" class="form-control" required>
                                            <option value="">Select Teacher</option>
                                        </select> 
                                    </div>
                                </div> -->
                                <div class="row mb-3 col-md-6">
                                    <label for="name" class="col-md-8 col-form-label text-md-end">Class Name<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <input  type="text" class="form-control" name="name" value="">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="mx-5 box-footer">
                            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i> Save </button>
                            <a href="{{URL::route('academic.class')}}" class="btn btn-default">Cancel</a>
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
            Academic.iclassInit();
            $('.have_selective_subject').on('ifChecked ifUnchecked', function(event) {
                if (event.type == 'ifChecked') {
                    $('#max_selective').show();
                } else {
                    $('#max_selective').hide();
                }
            });
        });
    </script>

@endsection
<!-- END PAGE JS-->
