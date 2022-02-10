import Vue from "vue";

Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        window.onclick = (event) => {
            binding.value(event)
        }
    },
});
