<template>
  <section>
    <b-modal ref="modelReverse" :title="`คืนเงินให้กับ ${payment ? payment.fullname : ''}`" @ok="submit">
      <b-form-group label-for="evidence" label="หลักฐานการคืนเงิน" horizontal>
        <b-form-file v-model="evidence" id="evidence"></b-form-file>
      </b-form-group>
      <b-form-group label-for="reason" label="เหตุผล" horizontal>
        <b-form-textarea v-model="reason" id="reason"></b-form-textarea>
      </b-form-group>
    </b-modal>
  </section>
</template>

<script>
import swal from "sweetalert2";
export default {
    data() {
        return {
            evidence: "",
            reason: "",
            payment: ""
        };
    },
    methods: {
        open(payment) {
            this.payment = payment;
            this.$refs.modelReverse.show();
        },
        submit(e) {
            e.preventDefault()
            this.alertConfirm(
                "ยืนยันการดำเนินการ",
                "คุณต้องการคืนให้ลูกค้าเงินใช่หรือไม่"
            ).then(result => {
                if (result.value) {
                    const payload = new FormData();
                    payload.append('payment_id', this.payment.id);
                    payload.append('evidence', this.evidence, this.evidence.name);
                    payload.append('reason', this.reason);
                    axios
                        .post("/admin/api/payment/confirm/3", payload)
                        .then(({ data }) => {
                            this.$emit('success')
                            swal({
                                type: "success",
                                title: "ดำเนินการสำเร็จ"
                            });
                        })
                        .catch(error => {
                            console.log(error);
                            if (error.response) {
                                console.log(error.response);
                                swal({
                                    type: "error",
                                    title: "Oops...",
                                    text: error.response.data.message
                                });
                            }
                        });
                }
            });
        }
    }
};
</script>

<style>
</style>
