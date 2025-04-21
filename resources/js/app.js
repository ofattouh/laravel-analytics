import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Initialize Vue app
import { createApp } from 'vue'

// Declare Vue Components
import PostsIndex from './components/Posts/Index.vue';
import PostsIndex2 from './components/Posts/Index2.vue';

// Create Vue app
const app = createApp({});

// Add Vue Components
app.component('posts-index', PostsIndex);
app.component('posts-index-2', PostsIndex2);

// Mount Vue components to id="app" defined in view: app.blade.php
app.mount('#app');
