
import { createApp } from 'vue'
import router from './router/index.js'
import App from './App.vue'
import ToastPlugin from 'vue-toast-notification';

// bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js'
import 'vue-toast-notification/dist/theme-bootstrap.css';

const app = createApp(App)
app.use(router)
app.use(ToastPlugin)

app.mount('#app')
