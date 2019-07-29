
require('./bootstrap');

window.Vue = require('vue');


Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('like', require('./components/Like.vue').default);
Vue.component('save', require('./components/Save.vue').default);

Vue.component('recipe', require('./components/Recipe.vue').default);

let url = window.location.href;
let pageNumber = url.split('=')[1];


// const app = new Vue({
//     el: '#app',
// });

const like = new Vue({
    el: '#like',
});

const save = new Vue({
    el: '#save',
});


const app = new Vue({
	el: '#app',

	data:{
		recipe:{},
	},

	mounted(){
        axios.post('/author/getRecipes/',{
        	'page' : pageNumber
        })
            .then(response => {
            	this.recipe = response.data.data;
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
        },
});