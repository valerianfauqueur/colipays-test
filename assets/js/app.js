import Home from './components/Home';
import App from './components/App';
import UserIndex from './components/user/Index.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: 'home', component: Home },
        { path: '/users', name: 'userIndex', component: UserIndex }
    ]
});

Vue.use(Vuetify);
Vue.use(VueRouter);

new Vue({
    el: '#app',
    vuetify : new Vuetify(),
    router: router,
    render: h => h(App),
});
