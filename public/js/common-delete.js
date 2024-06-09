$(document).on('click', '.delete-btn', function(event) {
    event.preventDefault();
    const url = $(this).data('url');
    const name = $(this).data('name'); 
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

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
                    "_token": csrfToken
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
