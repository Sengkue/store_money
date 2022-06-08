import { createWebHistory, createRouter } from "vue-router";
import Home from "../Pages/Home.vue";
import Spend from "../Pages/Spend.vue";
import Come from "../Pages/Come.vue";
import Borrow from "../Pages/Borrow.vue";
import Login from "../Pages/Login.vue";
import Register from "../Pages/Register.vue";
import Report from "../Pages/Report.vue";
import Store from "../Pages/Store.vue";
import Transection from "../Pages/Tramsection.vue"
export const routes = [
    {
        name: "Login",
        path:"/login",
        component: Login
        },
        {
            name: "Register",
            path:"/register",
            component: Register
            },
            {
                name: "Report",
                path:"/report",
                component: Report
                },
                {
                    name: "Store",
                    path:"/store",
                    component: Store
                    },
                    {
                        name: "Transection",
                        path:"/transection",
                        component: Transection
                        },
{
name: "Home",
path:"/",
component: Home
},
{
name: "Spend",
path:"/spend",
component: Spend
},
{
name: "Come",
path:"/come",
component: Come
},
{
    name: "Borrow",
    path:"/borrow",
    component: Borrow
    }
];
const router = createRouter({
history: createWebHistory(),
routes: routes,
scrollBehavior(){
window.scrollTo(0,0);
}
});
export default router;