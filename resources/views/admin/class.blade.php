@extends('layouts/layout')
@section('title', 'Class')
@section('content')
<div class="card shadow mb-4 col-lg-8">
    <!-- Card Header - Accordion -->
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Class</h6>
    </div>
    <!-- Card Content - Collapse -->
    
        <div class="card-body">
            

            <form method="POST" action="{{ route('saveClass')}}">
                @csrf
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Class Name <i style="color:red;">*</i></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword" placeholder="">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Notes</label>
                <div class="col-sm-10">
                  <textarea class="form-control" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Strength</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="inputPassword" placeholder="">
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Save</button>

            </form>

        </div>
    
</div>
 @endsection