@extends('layouts/layout')
@section('title', 'Dashboard')
@section('content')

@if(Auth::user()->role == 1)
<h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>
@endif

<div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="card1 col-xl-3 col-md-6 mb-4" style="cursor: pointer;">
            <!-- <a href="{{ route('user-list') }}" target="_blank" style="text-decoration:none;"> -->
                <div class="card border-left-primary shadow h-100 py-2 ">
                    <div class="card-body ">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Users
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </a> -->
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="card2 col-xl-3 col-md-6 mb-4" style="cursor: pointer;">
            <!-- <a href="{{ route('offline-payment') }}" target="_blank" style="text-decoration:none;"> -->
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Payment Collection
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </a> -->
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="card3 col-xl-3 col-md-6 mb-4" style="cursor: pointer;">
            <!-- <a href="{{ route('subject-list') }}" target="_blank" style="text-decoration:none;"> -->
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <span id="subjectPercentage">Loading..</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 0%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </a> -->
        </div>

        <!-- Pending Requests Card Example -->
        <div class="card4 col-xl-3 col-md-6 mb-4" style="cursor: pointer;">
            <!-- <a href="#" style="text-decoration:none;"> -->
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </a> -->
        </div>
    </div>

 @endsection