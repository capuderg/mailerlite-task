require('./bootstrap');

window.Vue = require('vue');

import VueToast from 'vue-toast-notification'
import MailerliteApp from './components/MailerliteApp'
import store from '../js/store'
import 'vue-toast-notification/dist/index.css'

Vue.use(VueToast, {
    position: 'top',
    duration: 6000
})

Vue.component('mailerlite-app', MailerliteApp)

const app = new Vue({
    el: '#app',
    store
});
