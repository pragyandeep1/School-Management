@extends('layouts.layout')
@section('title', 'Assign List')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Assignment List</h2>
            </div>
            @if(Auth::user()->role == 1)
            <div class="col-md-6 text-right">
                <a href="{{ route('assignments.create') }}" class="btn btn-secondary right-0"><i class="fa fa-plus-circle"></i>
                    Add Assignment
                </a>
            </div>
            @endif
        </div>
        <!-- Add a search bar here -->
        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width="8%">Sl</th>
                    <th width="18%">School</th>
                    <th width="18%">Branch</th>
                    <th width="18%">Class</th>
                    <th width="18%">Section</th>
                    <th width="18%">Subject</th>
                    @if(Auth::user()->role == 1)
                    <th width="18%">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        {{--<td>{{ $assignment->name }}</td>--}}
                        <td>{{ $assignment->school_name }}</td>
                        <td>{{ $assignment->branch_name }}</td>
                        <td>{{ $assignment->class }}</td>
                        <td>{{ $assignment->section }}</td>
                        <td>{{ $assignment->subject }}</td>
                        @if(Auth::user()->role == 1)
                        <td class="d-flex">
                            <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <form method="post" action="{{ route('assignments.destroy', $assignment->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Add page redirection links at the bottom right corner -->
    </div>
@endsection
