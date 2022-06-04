import { createWebHistory, createRouter } from "vue-router";
import Home from "../Pages/Home.vue";
import Spend from "../Pages/Spend.vue";
import Come from "../Pages/Come.vue";
import Borrow from "../Pages/Borrow.vue";
export const routes = [
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