@extends('layouts/layout') <!-- Use your own layout file as needed -->
@section('title', 'Activity Log')
@section('content')
<div class="card shadow mb-4 col-lg-12">
  
    <div  class="d-block card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Administrator Activity Log</h4>
    </div>

    <div class="card-body">
         <div class="table-responsive col-lg-12">
            <table class="table table-bordered table-striped" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($activityLog as $key=>$log): ?>
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $log->name }}</td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->description }}</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
