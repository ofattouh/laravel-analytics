import { createRouter, createWebHistory } from 'vue-router';

// Declare Vue Components
import UserDashboard from '@/components/UserDashboard.vue';
import PostsCreate from '@/components/Posts/Create.vue';
import PostsIndex from '@/components/Posts/Index.vue';
import PostsIndex2 from '@/components/Posts/Index2.vue';

// Build list of routes
const routes = [
    {
        path: '/dashboard',
        name: 'user.dashboard',
        component: UserDashboard
    },
    {
        path: '/posts/create',
        name: 'posts.create',
        component: PostsCreate
    },
    {
        path: '/posts/index',
        name: 'posts.index',
        component: PostsIndex
    },
    {
        path: '/posts/index2',
        name: 'posts.index2',
        component: PostsIndex2
    },
]

// Initialize Vue router
export default createRouter({
    history: createWebHistory(),
    routes
})

/*
    By defining/binding routes :to names, if route path is changed, we only need to change path in 1 file

*/
