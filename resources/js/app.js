import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener('DOMContentLoaded', () => {
    const flashSuccess = document.getElementById('flash-success');
    if (flashSuccess) {
        Swal.fire({
            title: 'Berhasil!',
            text: flashSuccess.dataset.message,
            icon: 'success',
            confirmButtonColor: '#005EAD', 
            timer: 3000,
            timerProgressBar: true
        });
    }
});