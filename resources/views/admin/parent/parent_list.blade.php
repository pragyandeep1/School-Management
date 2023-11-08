@extends('layouts.layout')
@section('title', 'Guardian List')
@section('content')
<div class="container">
     
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Parent List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @php 
                            $parents = \App\Models\Student::all();
                        @endphp
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Guardian Name</th>
                                    <th>Occupation</th>
                                    <th>Mobile No</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parents as $key => $p)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{$p->guardian_name}}</td>
                                    <td>{{$p->occupation}}</td>
                                    <td>{{$p->guardian_phone}}</td>
                                    <td>{{$p->guardian_email}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
