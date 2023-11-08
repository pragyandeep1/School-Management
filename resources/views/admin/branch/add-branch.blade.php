@extends('layouts/layout')
@section('title', 'Add Branch')
@section('content')
<h1 class="h3 mb-4 text-gray-800 col-md-12 text-uppercase">Branch</h1>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Branch</h6>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('save-branch') }}" enctype="multipart/form-data">
            @csrf
	
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <select name="school" id="school_id" class="form-control">
                        <option selected="selected">Select School *</option>
                        @foreach($school as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Name <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <input id="branch_id" type="text" class="form-control" name="branch_name" required autocomplete="off" autofocus>
                        <span class="text-danger">{{ $errors->first('branch_name') }}</span>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Head <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="branch_head" type="text" class="form-control" name="branch_head" value="" required autocomplete="off" autofocus>
                        <span class="text-danger">{{ $errors->first('branch_head') }}</span>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Principal Name </label>
                    <div class="col-md-12">
                        <input  type="text" class="form-control" name="branch_pri_name" value="" autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
			
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Email Id <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Phone No <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <input id="phone" type="number" class="form-control" name="branch_phone_no" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">City <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="district" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">State <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <select name="state" id="stateId" class="form-control select-arrow-cust widget_input" required>
                            <option value="">Select</option>
                            @foreach($state as $key=>$row)
                                <option value="{{ $key }}">{{ $row }}</option>
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
                        <input id="" type="number" class="form-control" name="total_student" value=""  autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Teachers</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_teacher" value=""  autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Other employee</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_support_employee" value=""  autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Area Pincode <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="pin" type="number" class="form-control" name="area_pin_code" value="" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Branch Address<i class="text-danger">*</i></label>

                    <div class="col-md-12">
                        <textarea class="form-control" name="branch_address"></textarea>
                    </div> 
                </div> 
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="system_logo" class="col-md-8 col-form-label text-md-end">System Logo
                        <i style="color:red;">*</i>
                    </label>
                    <div class=" col-md-12">
                        <input type="file" name="system_logo" accept=".jpeg, .jpg, .png" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="text_logo" class="col-md-8 col-form-label text-md-end">Text Logo</label>
                    <div class=" col-md-12">
                        <input type="file" name="text_logo" accept=".jpeg, .jpg, .png" class="form-control" placeholder="logo">
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="printing_logo" class="col-md-8 col-form-label text-md-end">Printing Logo</label>
                    <div class=" col-md-12">
                        <input type="file" name="printing_logo" accept=".jpeg, .jpg, .png" class="form-control" placeholder="logo">
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="report_card" class="col-md-8 col-form-label text-md-end">Report Card</label>
                    <div class=" col-md-12">
                        <input type="file" name="report_card" accept=".jpeg, .jpg, .png" class="form-control" placeholder="logo">
                    </div>
                </div>
            </div>

            <div class="row mb-3 col-md-6">
                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
				<div class="col-md-12">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
         </form>
    
    </div>
</div>
@endsection