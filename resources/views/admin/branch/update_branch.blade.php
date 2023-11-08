@extends('layouts/layout')
@section('title', 'Update Branch')
@section('content')
<h1 class="h3 mb-4 text-gray-800 col-md-12 text-uppercase">Branch</h1>

<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update Branch</h6>
    </div>
    <div class="card-body">
         <form method="POST" novalidate id="entryForm" action="{{ route('update-branch') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $branch->user_id }}">

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <select name="school_name" id="school_id" class="form-control">
                            <option selected="selected">Select</option>
                            <?php 
                            foreach ($school as $row):
                                $selected = ($row->id == $branch->school_id) ? 'selected' : '';
                            ?>
                                <option value="{{ $row->id }}" {{ $selected }}>{{ $row->name }}</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
             	<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Name <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="branch_name" value="{{ $branch->branch_name }}" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Head <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="branch_head" type="text" class="form-control" name="branch_head" value="{{ $branch->branch_head }}" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Principal Name <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input  type="text" class="form-control" name="branch_pri_name" value="{{ $branch->branch_pri_name }}" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Email Id <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $branch->email }}" required autocomplete="off" autofocus disabled> 
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Phone No <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="branch_phone_no" value="{{ $branch->branch_phone_no }}" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">City <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="district" value="{{ $branch->district }}" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">State <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="state" id="state" class="form-control">
                            <option value="">Select</option>
                            @foreach($state as $key=>$row)
                                <option value="{{ $key }}" {{ $key==$branch->state ? 'selected' : '' }}>{{ $row }}</option>
                            @endforeach
                        </select>                 
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-4">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Students</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_student" value="{{ $branch->total_student }}"  autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Teachers</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_teacher" value="{{ $branch->total_teacher }}"  autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Other employee</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_support_employee" value="{{ $branch->total_support_employee }}"  autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Area Pincode <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="pin" type="number" class="form-control" name="area_pin_code" value="{{ $branch->area_pin_code }}" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Address<i class="text-danger">*</i></label>

                    <div class="col-md-12">
                        <textarea class="form-control" name="branch_address">{{ $branch->branch_address }}</textarea>
                    </div> 
                </div> 
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="system_logo" class="col-md-8 col-form-label text-md-end">System Logo</label>
                    <div class=" col-md-12">
                        <input type="file" name="system_logo" accept=".jpeg, .jpg, .png" class="form-control" value="" required>
                    </div>
                    @if($branch->system_logo)
                        <div class="col-md-12">
                            <img src="{{ asset('upload/branch_images/'.$branch->system_logo) }}" alt="System Logo" height="120" width="200">
                        </div>
                    @endif
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="text_logo" class="col-md-8 col-form-label text-md-end">Text Logo</label>
                    <div class=" col-md-12">
                        <input type="file" name="text_logo" accept=".jpeg, .jpg, .png" class="form-control" value="" required>
                    </div>
                    @if($branch->text_logo)
                        <div class="col-md-12">
                            <img src="{{ asset('upload/branch_images/'.$branch->text_logo) }}" alt="Text Logo" height="120" width="200">
                        </div>
                    @endif
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="printing_logo" class="col-md-8 col-form-label text-md-end">Printing Logo</label>
                    <div class=" col-md-12">
                        <input type="file" name="printing_logo" accept=".jpeg, .jpg, .png" class="form-control" value="" required>
                    </div>
                    @if($branch->printing_logo)
                        <div class="col-md-12">
                            <img src="{{ asset('upload/branch_images/'.$branch->printing_logo) }}" alt="Text Logo" height="120" width="200">
                        </div>
                    @endif
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="report_card" class="col-md-8 col-form-label text-md-end">Report Card</label>
                    <div class=" col-md-12">
                        <input type="file" name="report_card" accept=".jpeg, .jpg, .png" class="form-control" value="" required>
                    </div>
                    @if($branch->report_card)
                        <div class="col-md-12">
                            <img src="{{ asset('upload/branch_images/'.$branch->report_card) }}" alt="Text Logo" height="120" width="200">
                        </div>
                    @endif
                </div>
            </div>

            <script>
                // Add an event listener to the file input
                document.getElementById('system_logo_input').addEventListener('change', function(e) {
                    const selectedFile = e.target.files[0];
                    const selectedFileName = selectedFile ? selectedFile.name : '';
                    const selectedFileSpan = document.getElementById('selected_file_name');
                    selectedFileSpan.textContent = `Selected File: ${selectedFileName}`;
                });
            </script>

            <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
				<div class="col-md-12">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
         </form>
    </div>
</div>
@endsection

