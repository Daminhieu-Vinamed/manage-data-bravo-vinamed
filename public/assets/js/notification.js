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
  title: "THÔNG BÁO !",
  allowOutsideClick: falseValue,
  allowEscapeKey: falseValue,
})

let timerInterval
var ToastSuccessCenterTime = Swal.mixin({
    icon: 'success',
    html: 'Hệ thống sẽ tự động điều hướng đến màn hình danh sách đề nghị thanh toán.\n Thời gian còn <b></b> milli giây',
    timer: 3000,
    timerProgressBar: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
})