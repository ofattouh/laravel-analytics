import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Initialize Vue app
import { createApp } from 'vue'

// Declare Vue Component
import PostsIndex from './components/Posts/Index.vue'

const app = createApp({});

// Add Vue Component
app.component('posts-index', PostsIndex)

// Mount Vue component to id="app" in app.blade.php
app.mount('#app')
