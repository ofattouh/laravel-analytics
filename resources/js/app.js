import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue'

// Vue root/main component which has HTML main layout
import App from './layouts/App.vue';

// Vue routes definitions file
import router from './routes/index';

// Initialize Vue app with Vue root component which has HTML main layout (instead of PHP Laravel Blade files)
const app = createApp(App);

// Enable Vue router
app.use(router) ;

// Mount Vue components to id="app" defined in view: dashboard.blade.php
app.mount('#app');

/*

    // Initialize Vue app and NOT passing any Vue component
    const app = createApp({});

    // Add Vue Component
    app.component('posts-index', PostsIndex);

*/
