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

window.addEventListener('successMessage', event => {
    swal_success(event.detail.message);
})

window.addEventListener('errorMessage', event => {
    swal_error(event.detail.message);
})