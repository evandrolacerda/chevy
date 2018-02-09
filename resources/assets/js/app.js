
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.bus = new Vue();

Vue.component('notifications', require('./components/NotificationsComponent.vue'));
Vue.component('photo', require('./components/Photo.vue'));
Vue.component('gallery', require('./components/gallery.vue'));
Vue.component('user-menu', require('./components/Menu.vue'));


const app = new Vue({
    el: '#app',
    methods: {
      addPhoto( newPhoto )
      {
          Vue.set(app.gallery);
      }
    },
    
    created() {
        bus.$emit('botao-clicado', 15 );

    }
});

