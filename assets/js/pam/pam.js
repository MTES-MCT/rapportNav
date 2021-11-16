import Vue from "vue";
import CreateRapportComponent from "./components/pages/CreateRapportComponent";
import HeaderComponent from "./components/HeaderComponent";

new Vue({
    components: { HeaderComponent },
    template: '<HeaderComponent />',
}).$mount('#headerComponent ')

new Vue({
    components: { CreateRapportComponent },
    template: '<CreateRapportComponent />',
}).$mount('#createRapportComponent ')