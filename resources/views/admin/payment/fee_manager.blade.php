@extends('layouts.layout')
@section('title', 'Fee Manager')
@section('content')
    <h1>Student Fee Manager</h1>

    <div class="row">
        <div class="col-md-6">
            <h4 class="m-0 font-weight-bold text-primary">Add New Student Fee</h4>
            <form method="POST" action="{{ route('fee-manager.save') }}">
                @csrf

                <div class="form-group">
                    <label for="student_name">Student Name</label>
                    <input type="text" name="student_name" id="student_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

        <div class="col-md-6">
            <h2>Student Fee List</h2>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentFees as $fee)
                        <tr>
                            <td>{{ $fee->student_name }}</td>
                            <td>{{ $fee->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
