<template>
<div class="section-container" id="checkout-cart">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN checkout -->
        <div class="checkout">
            <form method="POST" name="form_checkout">
                <!-- BEGIN checkout-header -->
                <div class="checkout-header">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="step active">
                                <router-link to="#">
                                    <div class="number">1</div>
                                    <div class="info">
                                        <div class="title">Delivery Options</div>
                                        <div class="desc">Lorem ipsum dolor sit amet.</div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <!-- END col-4 -->
                        <!-- BEGIN col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="step">
                                <router-link to="checkout_payment">
                                    <div class="number">2</div>
                                    <div class="info">
                                        <div class="title">Payment</div>
                                        <div class="desc">Aenean ut pretium ipsum. </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <!-- END col-4 -->
                        <!-- BEGIN col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="step">
                                <router-link to="checkout_complete">
                                    <div class="number">3</div>
                                    <div class="info">
                                        <div class="title">Complete Payment</div>
                                        <div class="desc">Curabitur interdum libero.</div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <!-- END col-4 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END checkout-header -->
                <!-- BEGIN checkout-body -->
                <div class="checkout-body">
                    <div class="table-responsive">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cart-product">
                                        <div class="product-img">
                                            <img src="/assets/img/product/product-iphone-6s-plus.png" alt="">
                                        </div>
                                        <div class="product-info">
                                            <div class="title">Running a Mobile App Dev Business: The Complete Guide</div>
                                            <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi gravida vel sapien et elementum. Proin id turpis eu sapien condimentum sagittis a quis tortor. Duis feugiat velit ut risus convallis mattis</div>
                                        </div>
                                    </td>
                                    <td class="cart-price text-center">฿749.00</td>
                                    <td ></td>
                                    <td class="cart-total text-center">฿749.00</td>
                                </tr>
                                <tr>
                                    <td class="cart-summary" colspan="4">
                                        <div class="summary-container">
                                            <div class="summary-row">
                                                <div class="field">Cart Subtotal</div>
                                                <div class="value">฿749.00</div>
                                            </div>
                                            
                                            <div class="summary-row total">
                                                <div class="field">Total</div>
                                                <div class="value">฿749.00</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END checkout-body -->
                <!-- BEGIN checkout-footer -->
                <!-- <div class="checkout-footer" v-for="(item, i) in items" :key="i"> -->
                <div class="checkout-footer">
                    <!-- <a href="#" class="btn btn-white btn-lg pull-left" @click="increaseIndex()">Continue Shopping {{item.test}}</a> -->
                    <router-link to="/" class="btn btn-white btn-lg pull-left">Continue Shopping</router-link>
                    <router-link to="checkout_payment" class="btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10">Checkout</router-link>
                    
                </div>
                <!-- END checkout-footer -->
            </form>
        </div>
        <!-- END checkout -->
    </div>
    <!-- END container -->
</div>
</template>

<script>
export default {
  data: () => ({
      index: 20,
      items: [{test:1},{test:2}]
  }),
  methods: {
      increaseIndex() {
          const index2 = 2;
          this.index = index2;
      }
  }
};
</script>

<style>

</style>
