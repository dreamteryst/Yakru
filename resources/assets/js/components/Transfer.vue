<template>
  <section>
    <div class="row m-b-3" v-for="(bank, i) in banks" :key="i">
      <div class="col-sm-3">
        <img :src="bank.bank_logo" alt="" class="img-responsive" />
      </div>
      <div class="col-sm-9">
        <span>{{ bank.bank_name }}</span><br/>
        <span><b>เลขบัญชี : </b>{{ bank.account_no }}</span><br/>
        <span><b>ชื่อบัญชี : </b>{{ bank.account_name }}</span><br/>
        <span><b>สาขา : </b>{{ bank.bank_branch }}</span><br/>
        <hr/>
      </div>
    </div>
  </section>
</template>

<script>
export default {
    data() {
        return {
            banks: ""
        };
    },
    mounted() {
        axios
            .get("/api/bank")
            .then(({ data }) => {
                this.banks = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
    }
};
</script>

<style>
</style>
