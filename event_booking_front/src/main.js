
import { createApp } from 'vue'
import router from './router/index.js'
import App from './App.vue'
import ToastPlugin from 'vue-toast-notification';

// bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js'
import 'vue-toast-notification/dist/theme-bootstrap.css';

//laravel broadcusting
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6eceb5a9373a64751a88',
    cluster: 'ap2',
    forceTLS: true
});

const app = createApp(App)
app.use(router)
app.use(ToastPlugin)

app.mount('#app')
