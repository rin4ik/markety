
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var bootstrapSelect = require('bootstrap-select/js/bootstrap-select.js');

var catalog = require('./pages/admin/catalogs/Catalog.vue');  
window.Vue = require('vue');
window.events = new Vue();
window.flash = function(message, level = 'success') {
    window.events.$emit('flash', {
        message,
        level
    });
}
const eventBus = new Vue() 
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('categories', require('./pages/admin/categories/Categories.vue'));

Vue.component('catalogs', require('./pages/admin/catalogs/Catalogs.vue'));
Vue.component('products', require('./pages/admin/products/Productes.vue'));
Vue.component('Catalog', Vue.extend(catalog));  
Vue.component('Manufacturers', require('./pages/admin/manufacturers/Manufacturers.vue'));  
Vue.component('Filters', require('./pages/admin/filters/Filters.vue'));     
     
Vue.component('AllFilters', require('./pages/front/filters/AllFilters.vue'));     
Vue.component('productFilters', require('./pages/front/products/ProductFilters.vue'));     

Vue.component('flash', require('./components/Flash.vue')); 
Vue.use(bootstrapSelect)
const app = new Vue({
    el: '#app'
});
