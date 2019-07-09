
require('./bootstrap');

window.Vue = require('vue');


Vue.component('profile', require('./components/Profile.vue').default);


const app = new Vue({
    el: '#app',
});
