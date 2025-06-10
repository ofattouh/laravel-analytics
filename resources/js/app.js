import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue'

// Vue shared component which has HTML navigation layout
import AppNavigation from './layouts/AppNavigation.vue';

// Declare Vue Components
import UserDashboard from '@/components/User/UserDashboard.vue';
import PostsCreate from '@/components/Posts/Create.vue';
import PostsIndex from '@/components/Posts/Index.vue';
import PostsIndex2 from '@/components/Posts/Index2.vue';
import PostsEdit from '@/components/Posts/Edit.vue';
import ProductsIndex from '@/components/Products/Index.vue';
import xAPIPostsIndex from '@/components/xAPI/Posts/Index.vue';

// Vue routes definitions file
import router from './routes/index';

import VueSweetalert2 from 'vue-sweetalert2';

// Initialize Vue app, NOT passing any Vue components
const app = createApp({});

// Enable Vue router
// app.use(router) ;

// Enable package
app.use(VueSweetalert2);

// Add Vue Components
app.component('app-navigation', AppNavigation);
app.component('my-user-dashboard', UserDashboard);
app.component('post-create', PostsCreate);
app.component('post-index', PostsIndex);
app.component('posts-index-2', PostsIndex2);
app.component('post-edit', PostsEdit);
app.component('products-index', ProductsIndex);
app.component('xapi-posts-index', xAPIPostsIndex);

// Mount Vue components to id="app" defined in view: app.blade.php
app.mount('#app');


/*

    // Initialize Vue app with Vue root component which has HTML main layout (instead of PHP Laravel Blade files)
    const app = createApp(App);

    // Vue root component which has HTML main layout
    import AppContent from './layouts/AppContent.vue';

    app.component('app-content', AppContent);

    // https://casl.js.org/v6/en/guide/intro
    import { abilitiesPlugin } from '@casl/vue';
    import ability from './services/ability';
    .use(abilitiesPlugin, ability);

    // https://casl.js.org/v6/en/guide/define-rules#ability-builder-example
    // added in: resources/js/services/ability.js
    import { AbilityBuilder, Ability } from '@casl/ability';
    const { can, cannot, build } = new AbilityBuilder(Ability);
    export default build();

*/
