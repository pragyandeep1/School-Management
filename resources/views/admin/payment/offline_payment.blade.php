@extends('layouts/layout')
@section('title', 'Offline Payment')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-uppercase">Offline Payment</h1>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style-type: none">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="row mb-4 col-lg-12">
    <div class="col-md-6">
        <h4 class="m-0 font-weight-bold text-primary">Add Payment</h4>
    
         <form method="POST" action="{{ route('offline-payment') }}">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Student Name</label>
                <select class="form-control" id="student" name="student_name">
                    <option value="">Select</option>
                    @foreach ($studentFees as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end"> Amount <i style="color:red;">*</i></label>
                <div class="col-md-6">
                    <input id="number" type="number" class="form-control" name="amount" value="" required autocomplete="off" autofocus>
                </div>
            </div>

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Date <i style="color:red;">*</i></label>
                <div class="col-md-6">
                    <input id="date" type="date" class="form-control" name="payment_date" value="" required autocomplete="off" autofocus>
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
            <h2>Student Fee List</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offlinePayments as $payment)
                        <tr>
                            <td>{{ $payment->student_name }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->payment_date }}</td>
                        </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
</div>
@endsection