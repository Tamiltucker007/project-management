@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Task Details
                    </div>

                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $task->title }}</p>
                        <p><strong>Project:</strong> {{ $task->project->name }}</p>
                        <p><strong>Description:</strong> {{ $task->description }}</p>
                        <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
