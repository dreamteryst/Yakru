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
                                        <div class="title">คอร์ส</div>
                                        <div class="desc">คอร์สทั้งหมดในตะกร้า</div>
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
                                        <div class="title">การชำระเงิน</div>
                                        <div class="desc">เลือกวิธีการชำระเงิน</div>
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
                                        <div class="title">เสร็จสิ้น</div>
                                        <div class="desc">ชำระเงินเรียบร้อยแล้ว</div>
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
                                    <th>คอร์ส</th>
                                    <th class="text-center">ราคา</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">รวมทั้งสิ้น</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cart-product">
                                        <div class="product-img">
                                            <img src="/assets/img/product/react-native-cover.jpg" alt="">
                                        </div>
                                        <div class="product-info">
                                            <div class="title">React Native สำหรับมือใหม่!!</div>
                                            <div class="desc">React-Native คือ Cross-Platform Framework ที่ใช้ในการพัฒนา Native Mobile Application อย่าง Android และ iOS ที่พัฒนาโดยบริษัท Facebook Inc. React Native มีหลักการคล้ายกับ Xamarin คือมันสามารถ Reuse Code ได้มากกว่า 70% ในการทำแอพที่รันได้ทั้งบน Android และ iOS โดยใช้ภาษาหลักภาษาเดียว คือภาษา ReactJS (ES6 / JSX) ซึ่งใกล้เคียงกับ Javascript / Typescript / XML ในการพัฒนาแอพ ซึ่งเมื่อทำเสร็จ แอพจะทำงานไวใกล้เคียงกับการเขียนด้วย ภาษา Native อย่าง Java และ Swift/Objective-C
อีกหนึ่งจุดเด่นของ React Native คือการประยุกต์ใช้แนวคิดแบบ Reactive Programming ที่ทำให้การพัฒนารองรับการทำงานแบบ Asynchronous และมี State ที่ซับซ้อนได้
นอกจากนี้ในหลักสูตรจะมีการสอน Redux (State Container) ในการจัดการ State เพื่อให้การพัฒนารองรับระบบที่มีความซับซ้อนและดูเป็นมืออาชีพ รวมถึงการเขียนโค้ดที่ทำงานร่วมกับ Native API ที่เป็น Java หรือ Objective-C และแชร์ประสบการณ์การในพัฒนาแอพด้วย React-Native จริงๆ
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart-price text-center">฿330.00</td>
                                    <td ></td>
                                    <td class="cart-total text-center">฿330.00</td>
                                </tr>
                                <tr>
                                    <td class="cart-summary" colspan="4">
                                        <div class="summary-container">
                                            <div class="summary-row">
                                                <div class="field">ราคารวม</div>
                                                <div class="value">฿330.00</div>
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
                    <router-link to="/" class="btn btn-white btn-lg pull-left">เลือกคอร์สเพิ่ม</router-link>
                    <router-link to="checkout_payment" class="btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10">ดำเนินการ</router-link>
                    
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
