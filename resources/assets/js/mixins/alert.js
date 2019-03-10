import Vue from 'vue'
import Swal from 'sweetalert2'

Vue.mixin({
  methods: {
    alertError(msg = 'เกิดข้อผิดพลาดบางอย่าง') {
      return Swal({
        title: 'เกิดข้อผิดพลาด!',
        text: msg,
        type: 'error',
        showConfirmButton: false,
        timer: 2000
      })
    },
    alertSuccess(msg) {
      return Swal({
        title: 'สำเร็จ!',
        text: msg,
        type: 'success',
        showConfirmButton: false,
        timer: 2000
      })
    },
    alertWarning(msg) {
      return Swal({
        title: 'แจ้งเตือน!',
        text: msg,
        type: 'warning',
        showConfirmButton: false,
        timer: 2000
      })
    },
    alertConfirm(
      title = 'ยืนยันการดำเนินการ',
      text = 'คุณต้องดำเนินการต่อใช่หรือไม่',
      type = 'warning'
    ) {
      return Swal({
        title,
        text,
        type,
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
      })
    },
    alertErrorConfirm(
      title = 'ยืนยันการลบ',
      text = 'คุณต้องการลบข้อมูลใช่หรือไม่',
      type = 'error'
    ) {
      return Swal({
        title,
        text,
        type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
      })
    }
  }
})
