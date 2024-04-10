var ToastTopRight = Swal.mixin({
    toast: trueValue,
    position: 'top-right',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: falseValue,
    timer: 1500,
    timerProgressBar: trueValue,
    didOpen: function didOpen(toast) {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

var ToastErrorCenter = Swal.mixin({
  title: textNOTIFICATION,
  allowOutsideClick: falseValue,
  allowEscapeKey: falseValue,
})