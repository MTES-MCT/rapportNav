import Vue from 'vue';
import VueRouter from "vue-router";
import Toast from 'vue-toastification';
import './filters';
import './directives';
import moment from "moment";

Vue.use(Toast);
Vue.use(VueRouter);

moment.locale('fr');

const router = new VueRouter({
    mode: 'history',
    routes:[
        { path:'/pam', name:'home', component: require('./pages/HomeComponent.vue').default },
        { path:'/pam/rapport', name:'rapport', component: require('./pages/CreateRapportComponent.vue').default },
        { path: '*', redirect: '/' }
    ]
});
new Vue({
    el: '#app',
    router,
    render: h => h(require('./App.vue').default),
});
