function swal_success(message) {
    Swal.fire({
        icon: 'success',
        title: message,
        showConfirmButton: false,
        timer: 2000
    });
};

function swal_error(message) {
    Swal.fire({
        icon: 'error',
        title: message,
        showConfirmButton: false,
        timer: 2000
    });
};