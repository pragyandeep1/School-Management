@extends('layouts/layout')
@section('title', 'Profile Settings')
@section('content')
<div class="page-content">
        <div class="row profile-body">
          <!-- left wrapper start -->
          <div class="d-none d-md-block col-md-4 left-wrapper">
            <div class="card rounded">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <!-- Image content -->
                  <div>
                    <img class="wd-100 rounded-circle" src="{{url('admin/img/undraw_profile.svg')}}" alt="profile">
                    <span class="h4 ms-3">{{$profileData->username}}</span>
                  </div>
                  <!--// End Image content -->
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                  <p class="text-muted">{{$profileData->name}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                  <p class="text-muted">{{$profileData->email}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                  <p class="text-muted">{{$profileData->phone}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                  <p class="text-muted">{{$profileData->address}}</p>
                </div>
              </div>
            </div>
        </div>
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 middle-wrapper">
            <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Basic Info</h4>
                                </div>
              		<div class="card-body">
						        <h6 class="card-title">Update Admin Profile</h6>
							      <form method="POST" action="{{route('admin.profile.store')}}" class="forms-sample" enctype="multipart/form-data">
                      @csrf
                        <div class="col-md-6 mb-4">
                           <label for="InputName1" class="form-label">Name</label>
                           <input type="text" name="name" class="form-control" id="inputName1" autocomplete="off" value="{{$profileData->name}}" autofocus disabled>
                        </div>
        								<div class="col-md-6 mb-4">
        									<label for="InputEmail1" class="form-label">Email address</label>
        									<input type="email" name="email" class="form-control" id="inputEmail1" value="{{$profileData->email}}" autofocus disabled>
        								</div>
                        <!-- <div class="col-md-6 mb-4">
                          <label for="image" class="form-label">Photo</label>
                          <input type="file" name="profile_image" class="form-control" id="image">
                        </div> -->
                        <div class="col-md-6 mb-4">
                            <div class="avatar-xxl me-3">
                                <img id="showimg" class="img-fluid rounded-circle d-block img-thumbnail" src="{{(!empty($profileData->photo))? url('upload/admin_images/'.$profileData->photo): url('admin/img/undraw_profile.svg')}}" alt="profile">
                            </div>
                        </div>

        								<button type="submit" class="btn btn-primary me-2" autofocus disabled>Save Changes</button>
        						</form>
              		</div>
                  </div>
            		</div>
            	</div>

              
          	</div>
          	<!-- middle wrapper end -->
          	<!-- right wrapper start -->
          	<div class="d-none d-xl-block col-xl-3"></div>
        	<!-- right wrapper end -->
    	</div>
	</div>

  <script type="text/javascript">
    $(document).ready(function()
     {
        $('#image').change(function(e)
          {
            var reader = new fileReader();
            reader.onload = function(e)
             {
                $('#showImage').attr('src', e.target.result);
             }
            reader.readAsDataUrl(e.target.files['0']);
          });
      });
  </script>
@endsection