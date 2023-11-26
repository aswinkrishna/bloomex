import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './App.vue';
import List from './components/List.vue';
import Add from './components/Add.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: List },
        { path: '/create', component: Add },
        { path: '/edit/:id', component: Add },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');