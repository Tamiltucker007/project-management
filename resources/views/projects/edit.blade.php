@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Edit Project
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('projects.update', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $project->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Assigned Team Member</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" aria-label="Default select example" id="user_id" name="user_id">
                                    <option value="" selected>Select Team Member</option>
                                    @if ($teamMembers)
                                    @foreach ($teamMembers as $teamMember)
                                        <option value="{{ $teamMember->id }}" {{ $project->user_id == $teamMember->id ? 'selected' : '' }}>{{ $teamMember->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        value="{{ $project->start_date }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                        value="{{ $project->end_date }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $project->description }}</textarea>
                            </div>
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ route('projects.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
