<template>
  <section>
    <form method="post" @submit="onSubmit">
      <b-alert variant="danger" :show="this.error !== ''">{{ this.error }}</b-alert>
      <div class="form-group">
        <label for="cardNumber">Card Number</label>
        <input
          type="text"
          id="cardNumber"
          placeholder="Card number"
          class="form-control"
          v-model="cardNumber"
          required
        >
      </div>
      <div class="form-group">
        <label for="nameOnCard">Name on card</label>
        <input
          type="text"
          id="nameOnCard"
          placeholder="Name on card"
          class="form-control"
          v-model="nameOnCard"
          required
        >
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label for="expiryMonth">Expiry Month</label>
            <select
              id="expiryMonth"
              placeholder="Expiry Month"
              class="form-control"
              v-model="expiryMonth"
              required
            >
              <option v-for="i in 12" :key="i">{{ i }}</option>
            </select>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="expiryYear">Expiry Year</label>
            <select
              id="expiryYear"
              placeholder="Expiry Year"
              class="form-control"
              v-model="expiryYear"
              required
            >
              <option v-for="i in 9" :key="i">20{{ i+16 }}</option>
            </select>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="cvv">Security code</label>
            <input
              type="text"
              id="cvv"
              placeholder="Security code"
              class="form-control"
              v-model="cvv"
              maxlength="3"
              required
            >
          </div>
        </div>
      </div>
      <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
      </div>
    </form>
  </section>
</template>

<script>
export default {
    data() {
        return {
            cardNumber: "",
            nameOnCard: "",
            expiryMonth: "",
            expiryYear: "",
            cvv: "",
            error: ""
        };
    },
    mounted() {
        $(function() {
            Omise.setPublicKey("pkey_test_5e2ycgike2y1y4dztck");
        });
    },
    methods: {
        onSubmit(event) {
            const self = this;
            event.preventDefault();
            const cardInformation = {
                name: this.nameOnCard,
                number: this.cardNumber,
                expiration_month: this.expiryMonth,
                expiration_year: this.expiryYear,
                security_code: this.cvv
            };
            Omise.createToken("card", cardInformation, function(
                statusCode,
                response
            ) {
                if (statusCode === 200) {
                    // Success: send back the TOKEN_ID to your server. The TOKEN_ID can be
                    // found in `response.id`.

                    console.log(response.id);
                    // checkoutForm.token.value = response.id;
                    // checkoutForm.submit();
                } else {
                    self.error = response.message;
                }
            });
        }
    }
};
</script>

<style>
</style>
