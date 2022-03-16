import "./bootstrap"
import Vue from "vue"
import vuetify from '@/js/plugins/vuetify'
import Route from '@/js/routes'
import App from '@/js/views/app'
import Auth from './plugins/auth.js';
import storage from './storage/storage.js';
import axios from 'axios'
import api from './api';
import VueAxios from 'vue-axios'
import Notifications from 'vue-notification'

window.auth = new Auth();

Vue.use(VueAxios, axios);
Vue.use(Notifications)
Vue.use(api);

Vue.axios.defaults.baseURL = '/api';
window.Event = new Vue;

const app = new Vue({
    el: "#app",
    storage,
    vuetify,
    router: Route,
    render: h => h(App)
});

export default app;
