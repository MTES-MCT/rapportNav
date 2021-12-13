import Vue from "vue";
import CreateRapportComponent from "./pages/CreateRapportComponent";
import Toast from "vue-toastification";

new Vue({
    components: { CreateRapportComponent },
    template: '<CreateRapportComponent />',
}).$mount('#createRapportComponent ')

Vue.use(Toast);
