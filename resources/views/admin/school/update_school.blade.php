@extends('layouts/layout')
@section('title', 'Update School')
@section('content')
<h1 class="h3 mb-4 text-gray-800 col-md-12 text-uppercase">School</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type: none;">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4 col-lg-12">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update School</h6>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('update-school') }}" enctype="multipart/form-data">
            @csrf
            <input  type="hidden"  name="user_id" value="{{ $school->user_id }}" >
            <div class="d-flex">
             	<div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">School Name <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $school->name }}" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Principal Name <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input  type="text" class="form-control" name="principal_name" value="{{ $school->principal_name }}" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            
            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Email Id <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $school->email }}" required autocomplete="off" autofocus disabled > 
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Phone No <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="phone_no" value="{{ $school->phone_no }}" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Phone No (Secondary)</label>
                    <div class="col-md-12">
                        <input id="" type="number" class="form-control" name="phone_no_se" value="{{ $school->phone_no_se }}"  autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Area Pincode <i style="color:red;">*</i></label>
    				<div class="col-md-12">
                        <input id="" type="number" class="form-control" name="area_pin_code" value="{{ $school->area_pin_code }}" required autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">City <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="district" value="{{ $school->district }}" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">State <i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <select name="state" id="state" class="form-control">
                            <option value="">Select</option>
                            @foreach($state as $key=>$row)
                                <option value="{{ $key }}" {{ $key==$school->state ? 'selected' : '' }}>{{ $row }}</option>
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
                        <input id="" type="number" class="form-control" name="total_class" value="{{ $school->total_class }}"  autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Students</label>
    				<div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_student" value="{{ $school->total_student }}"  autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Teachers</label>
    				<div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_teacher" value="{{ $school->total_teacher }}"  autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">No of Other employee</label>
    				<div class="col-md-12">
                        <input id="" type="number" class="form-control" name="total_support_employee" value="{{ $school->total_support_employee }}"  autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Address<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <textarea class="form-control" name="address">{{ $school->address }}</textarea>
                    </div>
                </div>

                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end">Logo<i style="color:red;">*</i></label>
                    <div class="col-md-12">
                        <input type="file" name="logo" accept=".jpeg, .jpg, .png" class="form-control" required autocomplete="off" autofocus @if(isset($school->image))data-default-file="{{asset('upload/school_images')}}/{{ $school->image }}" @endif >
                    </div>
                    @if($school->image)
                    <div class="col-md-12">
                        <img src="{{ asset('upload/school_images/'.$school->image) }}" alt="logo" height="120" width="200">
                    </div>
                    @endif
                </div>
            </div>

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