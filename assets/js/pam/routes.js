import Vue from 'vue';
import VueRouter from "vue-router";
import HomeComponent from "./pages/HomeComponent";
import CreateRapportComponent from "./pages/CreateRapportComponent";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: 'home', component: HomeComponent },
        { path: '/create', name: 'create', component: CreateRapportComponent }
    ],
    base: '/'
})

export default router;
