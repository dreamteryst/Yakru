import VueRouter from "vue-router";

import User from "./route/User";
import Home from "./components/Home";
import Profile from "./components/Profile";
import ProductDetail from "./components/ProductDetail";
import LiveStream from "./components/LiveStream";
import Contact from "./components/Contact";
import Payment from "./components/Payment";
import Learning from "./components/Learning";

import TeacherLiveStream from "./components/teacher/LiveStream";
import TeacherRegister from "./components/teacher/Register";

import Admin from "./route/Admin";
import AdminLogin from "./components/admin/auth/Login";
import AdminHome from "./components/admin/AdminHome";
import Dashboard from "./components/admin/Dashboard";
import CourseData from "./components/admin/CourseData";
import CourseAdd from "./components/admin/CourseAdd";
import LectureData from "./components/admin/LectureData";
import StudentData from "./components/admin/StudentData";
import TeacherData from "./components/admin/TeacherData";
import AccountingData from "./components/admin/AccountingData";
import SettingData from "./components/admin/SettingData";
import PaymentData from "./components/admin/PaymentData";
import TeacherRegisterData from "./components/admin/TeacherRegisterData";
import UnitData from "./components/admin/UnitData";
import OrderData from "./components/admin/OrderData";
import CategoryData from "./components/admin/CategoryData";
import CategoryAdd from "./components/admin/CategoryAdd";
import ExampleData from "./components/admin/ExampleData";
import ExampleAdd from "./components/admin/ExampleAdd";
import ExampleEdit from "./components/admin/ExampleEdit";
import TagData from "./components/admin/TagData";
import TagAdd from "./components/admin/TagAdd";
import PromotionAdd from "./components/admin/PromotionAdd";
import PromotionData from "./components/admin/PromotionData";
import CourseCalendar from "./components/admin/CourseCalendar";
import ScheduleData from "./components/admin/ScheduleData";
import UnitAdd from "./components/admin/UnitAdd";
import TopupData from './components/admin/TopupData'

import Auth from "./route/Auth";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";

import CheckoutCart from "./components/Checkout-Cart";
import CheckoutPayment from "./components/Checkout-Payment";
import CheckoutComplete from "./components/Checkout-Complete";

import Error404 from "./components/Error404";

window.Vue = require("vue");
Vue.use(VueRouter);

const routes = [
  {
    path: "",
    component: User,
    children: [
      { path: "", name: "Home", component: Home },
      { path: "profile", name: "Profile", component: Profile },
      {
        path: "product-detail/:id",
        name: "Product Detail",
        component: ProductDetail
      },
      { path: "checkout_cart", name: "checkout_cart", component: CheckoutCart },
      {
        path: "checkout_payment",
        name: "checkout_payment",
        component: CheckoutPayment
      },
      {
        path: "checkout_complete",
        name: "checkout_complete",
        component: CheckoutComplete
      },
      { path: "live-stream/:id", name: "live-stream", component: LiveStream },
      { path: "learning/:id", name: "learning", component: Learning },
      { path: "contact", name: "contact", component: Contact },
      { path: "payment", name: "payment", component: Payment },
      { path: "teacher/live-stream/:id", name: "teacher-live-stream", component: TeacherLiveStream },
      { path: "teacher/register", name: "teacher-register", component: TeacherRegister },
    ]
  },
  { path: "/admin/auth", name: "AdminLogin", component: AdminLogin },
  {
    path: "/admin",
    component: Admin,
    children: [
      { path: "", name: "Admin", component: Dashboard },
      { path: "dashboard", name: "Dashboard", component: Dashboard },
      { path: "course", name: "Course", component: CourseData },
      { path: "course/add", name: "CourseAdd", component: CourseAdd },
      { path: "course/unit/:id/add", name: "AddUnit", component: UnitAdd },
      { path: "course/unit/:id", name: "Unit", component: UnitData },
      { path: "course/example/edit/:id", name: "EditExample", component: ExampleEdit },
      { path: "course/example/:id/add", name: "AddExample", component: ExampleAdd },
      { path: "course/example/:id", name: "Example", component: ExampleData },
      { path: "course/live/:id", name: "Schedule", component: ScheduleData },
      { path: "course/calendar", name: "CourseCalendar", component: CourseCalendar },
      { path: "course/:id", name: "Lecuture", component: LectureData },
      { path: "student", name: "Student", component: StudentData },
      { path: "teacher", name: "Teacher", component: TeacherData },
      { path: "accounting", name: "Accounting", component: AccountingData },
      { path: "setting", name: "Setting", component: SettingData },
      { path: "payment", name: "Payment", component: PaymentData },
      { path: "teacher/register", name: "TeacherRegister", component: TeacherRegisterData },
      { path: "order", name: "Order", component: OrderData },
      { path: "category", name: "Category", component: CategoryData },
      { path: "category/add", name: "AddCategory", component: CategoryAdd },
      { path: "tag", name: "tag", component: TagData },
      { path: "tag/add", name: "Addtag", component: TagAdd },
      { path: "promotion", name: "Promotion", component: PromotionData },
      { path: "promotion/add", name: "AddPromotion", component: PromotionAdd },
      { path: "topup", name: "Topup", component: TopupData },
    ]
  },
  {
    path: "/auth",
    component: Auth,
    children: [
      { path: "", name: "Login", component: Login },
      { path: "register", name: "Register", component: Register }
    ]
  },
  { path: "/errors", name: "Page not found", component: Error404 },
  { path: "*", name: "404" }
];

const router = new VueRouter({
  mode: "history",
  routes: routes,
  scrollBehavior(to, from, savedPosition) {
    return { x: 0, y: 0 };
  }
});

router.afterEach((toRoute, fromRoute) => {
  if (toRoute.name == "404") {
    window.location.href = "/errors";
  }
  document.title = toRoute.name + " | Yakru";
  // console.log(toRoute)
});

export default router;
