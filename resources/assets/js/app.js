
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var category = require('./components/pages/categories/Category.vue'); 
window.Vue = require('vue');
window.events = new Vue();
window.flash = function(message, level = 'success') {
    window.events.$emit('flash', {
        message,
        level
    });
}
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('categories', require('./components/pages/categories/Categories.vue'));    
Vue.component('addCategory', require('./components/pages/categories/AddCategory.vue')); 
Vue.component('Category', Vue.extend(category));  
Vue.component('Manufacturers', require('./components/pages/manufacturers/Manufacturers.vue'));    


Vue.component('flash', require('./components/Flash.vue'));

const app = new Vue({
    el: '#app'
});
