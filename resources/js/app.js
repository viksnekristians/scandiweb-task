window.Vue = require('vue').default;

Vue.component('products', require('./components/Products.vue').default);
Vue.component('product-add', require('./components/ProductAdd.vue').default)
Vue.component('dvd-data', require('./components/FormData/DVDData.vue').default)
Vue.component('furniture-data', require('./components/FormData/FurnitureData.vue').default)
Vue.component('book-data', require('./components/FormData/BookData.vue').default)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
