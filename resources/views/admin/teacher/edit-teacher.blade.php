@extends('layouts/layout')
@section('title', 'Edit Teacher')
@section('content') 
<h1 class="h3 mb-4 text-gray-800">Teacher</h1>
    <!-- Section header -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li class="active" style="list-style-type:none;">Update Teacher</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <div class="card shadow mb-4 col-lg-12">
        <div class="card-body">
            <form novalidate id="entryForm" action="{{route('update-teacher', ['id' => $teacher->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="school" class="col-md-8 col-form-label text-md-end">Select School<i style="color:red;">*</i></label>
                        <div class="col-md-12">
                            <select name="school" id="school_id" class="form-control">
                                <option value="">Select</option>
                                <?php 
                            foreach ($schools as $row):
                                $selected = ($row->id == $teacher->school_id) ? 'selected' : '';
                            ?>
                            <option value="{{ $row->id }}" {{ $selected }}>{{ $row->name }}</option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="branch" class="col-md-8 col-form-label text-md-end">Branch<i style="color:red;">*</i></label>
                        <div class="col-md-12">
                            <select name="select_branch" class="form-control">
                                <option value="">Select</option>
                               <?php foreach ($branches as $row):
                                 $selected = ($row->id == $teacher->branch_id) ? 'selected' : '';
                                 ?>
                                    <option value="{{ $row->id }}" {{ $selected }}>{{ $row->branch_name }}</option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="name" class="col-md-8 col-form-label text-md-end">Name<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input autofocus type="text" class="form-control" name="name" placeholder="name" value="{{ $teacher->name }}" required minlength="2" maxlength="255">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    
                    <div class="row mb-3 col-md-6">
                        <label for="designation" class="col-md-8 col-form-label text-md-end">Designation<span class="text-danger">*</span></label>
                        <div class="col-md-12">
    						<select name="designation" id="designation" class="form-control">
                                <option value="">Select Designation</option>
                                <?php foreach($designation as $key=>$row): ?>
                                    <option <?php echo(isset($teacher) && $teacher->designation==$key)?'selected':''; ?> value="{{$key }}">{{ $row }}</option>
                                <?php endforeach; ?>
    						</select>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="qualification" class="col-md-8 col-form-label text-md-end">Qualification</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="qualification" placeholder="MA, BA, B. Sc" value="{{ $teacher->qualification }}" maxlength="255">
                            <span class="text-danger">{{ $errors->first('qualification') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="dob" class="col-md-8 col-form-label text-md-end">Date of birth<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type='date' class="form-control date_picker2"  name="dob" id="dob" placeholder="date" value="{{ $teacher->dob }}" required minlength="10" maxlength="255" />
                            <span class="text-danger">{{ $errors->first('dob') }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="gender" class="col-md-8 col-form-label text-md-end">Gender<span class="text-danger">*</span></label>
                        <div class="col-md-12">
    						<select name="gender" id="gender"  class="form-control">
                                <option value="">Select</option>
                                <?php foreach($gender as $key=>$row): ?>
                                    <option <?php echo(isset($teacher) && $teacher->gender==$key)?'selected':''; ?> value="{{$key }}">{{ $row }}</option>
                                <?php endforeach; ?>
    						</select>
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="religion" class="col-md-8 col-form-label text-md-end">Religion
                            <span class="text-danger">*</span>                
                        </label>
                        <div class="col-md-12">
                            <select name="religion" id="religion" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($religion as $key=>$row): ?>
                                    <option <?php echo(isset($teacher) && $teacher->religion==$key)?'selected':''; ?> value="{{$key }}">{{ $row }}</option>
                                <?php endforeach; ?>
    						</select>                   
                            <span class="text-danger">{{ $errors->first('religion') }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="email" class="col-md-8 col-form-label text-md-end">Email<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input  type="email" class="form-control" name="email"  placeholder="email address" value="{{$teacher->email}}" maxlength="100" required>
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="phone_no" class="col-md-8 col-form-label text-md-end">Phone/Mobile No.<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input  type="text" class="form-control" name="phone_no" required placeholder="phone or mobile number" value="{{$teacher->phone_no}}" min="8" maxlength="15">
                            <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="id_card" class="col-md-8 col-form-label text-md-end">ID Card No. / Employee ID<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input  type="text" class="form-control" name="id_card"  placeholder="id card number" value="{{$teacher->id_card}}" required minlength="4" maxlength="50">
                            <span class="text-danger">{{ $errors->first('id_card') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="joining_date" class="col-md-8 col-form-label text-md-end">Joining Date<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type='date' class="form-control"  name="joining_date" placeholder="date" value="{{$teacher->joining_date}}" required minlength="10" maxlength="255" />
                            <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row mb-3 col-md-6">
                        <label for="photo" class="col-md-8 col-form-label text-md-end">Photo</label>
                        <div class="col-md-12">
                            <input  type="file" class="form-control" accept=".jpeg, .jpg, .png" name="photo" value="">
                        </div>
                        @if($teacher->photo)
                        <div class="col-md-12">
                            <img src="{{ asset('upload/teacher/'.$teacher->photo) }}" alt="photo" height="120" width="200">
                        </div>
                        @endif
                    </div>
                    <div class="row mb-3 col-md-6">
                        <label for="leave_date" class="col-md-8 col-form-label text-md-end">Leave Date</label>
                        <div class="col-md-12">
                            <input type='date' class="form-control date_picker_with_clear" name="leave_date" placeholder="date" value="{{$teacher->leave_date}}"  minlength="10" maxlength="255" />
                            <span class="text-danger">{{ $errors->first('leave_date') }}</span>
                        </div>
                    </div>
                </div> 
                <div class="d-flex">       
                    @if($teacher)
                    
                    {{--<div class="row mb-3 col-md-6">
                        <label for="username" class="col-md-8 col-form-label text-md-end">Username<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input  type="text" class="form-control" value="" name="username" required minlength="5" maxlength="255">
                            <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        </div>
                    </div>--}}
                    @endif
                </div>
                <div class="row mb-3 col-md-6">
                    <label for="address" class="col-md-8 col-form-label text-md-end">Address</label>
                    <div class="col-md-12">
                        <textarea class="form-control" name="branch_address">{{ $teacher->address }}</textarea>
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="row mb-3 col-md-6">
                    <label for="name" class="col-md-8 col-form-label text-md-end"></label>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info pull-right"><!-- <i class="fas  fa-plus fa-xs"></i> --> Update </button>
                        <a href="" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.content -->
@endsection