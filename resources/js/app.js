import './bootstrap';
import { createApp } from 'vue';
import App from "./components/App";
import router from "./router"

const app = createApp({});
app.component('App', App);

app.use(router);
app.mount('#app');
