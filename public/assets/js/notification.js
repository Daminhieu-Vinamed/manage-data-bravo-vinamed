var ToastTopRight = Swal.mixin({
    toast: true,
    position: 'top-right',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: function didOpen(toast) {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

var ToastErrorCenter = Swal.mixin({
    icon: 'error',
    title: 'THÔNG BÁO !',
    allowOutsideClick: false,
    allowEscapeKey: false,
})