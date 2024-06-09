@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Tasks
                        <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary">Add New Tasks</a>
                    </div>

                    <div class="card-body">
                        {!! $dataTable->table(['class' => 'table table-bordered table-striped']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
@endsection

@push('scripts')
    <script src="{{ asset('js/common-delete.js') }}"></script>
@endpush
