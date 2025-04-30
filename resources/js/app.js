import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'

// Vue root/main component which has HTML main layout
import App from './layouts/App.vue';

// Declare Vue Components
import UserDashboard from './components/UserDashboard.vue';
import PostsCreate from './components/Posts/Create.vue';
import PostsIndex from './components/Posts/Index.vue';
import PostsIndex2 from './components/Posts/Index2.vue';

// Build list of routes
const routes = [
    { path: '/dashboard', component: UserDashboard },
    { path: '/posts/create', component: PostsCreate },
    { path: '/posts/index', component: PostsIndex },
    { path: '/posts/index2', component: PostsIndex2 },
]

// Initialize the router
const router = createRouter({
    history: createWebHistory(),
    routes
})

// Initialize Vue app with Vue main layout root component (instead of PHP Laravel Blade files)
const app = createApp(App);

// Enable Vue router
app.use(router) ;

// Mount Vue components to id="app" defined in view: dashboard.blade.php
app.mount('#app');

/*

    // NOT passing any Vue components
    const app = createApp({});

    // Add Vue Components
    app.component('posts-index', PostsIndex);
    app.component('posts-index-2', PostsIndex2);

*/
