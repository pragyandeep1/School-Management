@extends('layouts/layout')
@section('title', 'Expense Category')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-uppercase">Expense Category</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type: none;">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="row">
    <div  class="d-block card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('expense-save')}}">
            @csrf
         	
           
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Category Type <i style="color:red;">*</i></label>
                <div class="col-md-6">
                    <input id="text" type="text" class="form-control" name="name" value="" required autocomplete="off" autofocus>
                </div>
            </div>

             <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Category Name<i style="color:red;">*</i></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="off" autofocus>
                </div>
            </div>



            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end"></label>
				<div class="col-md-6">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>




         </form>
    
    </div>
    <div class="col-md-6">
            <h2>Expense Category List</h2>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    {{--@foreach ($expenseCategories as $fee)--}}
                        <tr>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                    {{--@endforeach--}}
                </tbody>
            </table>
        </div>
</div>
@endsection