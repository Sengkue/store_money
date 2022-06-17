import {createApp} from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "axios";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Cleave from 'vue-cleave-component';
import Pagination from "./Components/Pagination.vue";
import moment from 'moment'
 
require('./bootstrap');

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.use(VueSweetalert2);
app.use(Cleave);
app.use(moment);
app.component('pagination', Pagination);
app.mount("#app");