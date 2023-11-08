@extends('layouts/layout')
@section('title', 'Add School')
@section('content')
<h1 class="h3 mb-4 text-gray-800 col-md-12 text-uppercase">School</h1>

<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add School</h6>
    </div>
    
    <div class="card-body">
         <form method="POST" action="{{ route('save-school') }}" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
             	<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">School Name <i class="text-danger">*</i></label>
    				<div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Principal Name </label>
                    <div class="col-md-12">
                        <input  type="text" class="form-control" name="principal_name" autocomplete="off" autofocus>
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
                    <label for="name" class="col-md-8 col-form-label text-md-end">Phone No <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <input id="phone" type="number" class="form-control" name="phone_no" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Phone No (Secondary)</label>
                    <div class="col-md-12">
                        <input id="phone1" type="number" class="form-control" name="phone_no_se" autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Area Pincode <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <input id="pin" type="number" class="form-control" name="area_pin_code" required autocomplete="off" autofocus>
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
                    <label for="name" class="col-md-8 col-form-label text-md-end">Select State<i style="color:red;">*</i></label>
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
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Classes</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_class" autocomplete="off" autofocus>
                    </div>
                </div>
                
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Students</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_student" autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Teachers</label>
    				<div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_teacher" autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of other employees</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_support_employee" autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Address<i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="photo" class="col-md-8 col-form-label text-md-end">Logo</label>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="logo" alt="Logo image">
                        <span class="glyphicon glyphicon-open-file form-control-feedback" style="top:45px;"></span>
                        <span class="text-danger">{{ $errors->first('image') }}</span>
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