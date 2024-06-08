@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Users
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Add New User</a>
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
    <script>
        $(document).on('click', '.delete-btn', function(event) {
            event.preventDefault();
            const url = $(this).data('url');
            const name = $(this).data('name'); 
            
            Swal.fire({
                title: 'Are you sure?',
                text: `You will not be able to recover the user ${name}!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form for deletion
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: `${name} has been deleted.`,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON.message,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush


