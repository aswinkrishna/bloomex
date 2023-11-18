import Index from './Components/Index.vue';
import Add from './components/Add.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Index
    },
    {
        name: 'add',
        path: '/add',
        component: Add
    },
];