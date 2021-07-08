window.Vue = require('vue');

import App from './App.vue';
import router from './routes';

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

console.log('hello guest');
