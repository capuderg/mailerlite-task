require('./bootstrap');

window.Vue = require('vue');

import MailerliteApp from './components/MailerliteApp'
import store from '../js/store'

Vue.component('mailerlite-app', MailerliteApp)

const app = new Vue({
    el: '#app',
    store
});
