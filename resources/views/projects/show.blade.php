@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Project Details
                    </div>

                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $project->name }}</p>
                        <p><strong>Description:</strong> {{ $project->description }}</p>
                        <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                        <p><strong>End Date:</strong> {{ $project->end_date }}</p>

                        <h4>Assigned Users</h4>
                        <ul class="list-group">
                            @foreach ($project->teamMembers as $teamMember)
                                <li class="list-group-item">
                                    <a href="{{ route('users.show', $teamMember->id) }}">{{ $teamMember->name }}</a>
                                    <span class="badge bg-primary">{{ $teamMember->email }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
