import { ref } from 'vue'

// Composable reusable function
export default function usePosts() {
    const posts = ref([])

    const getPosts = async () => {
        axios.get('/api/posts').then(response => {
            posts.value = response.data;
        })
    }

    // Return exposed reactive stateful data:`posts` and exposed method:`getPosts`
    return { posts, getPosts }
}

/*

    In context of Vue applications, "composable" is function that leverages Vue Composition API to encapsulate
    and reuse stateful logic. Stateful logic involves managing state that changes over time

    Using Composition API, combine <script setup> with Vue 3 composables to write reusable Vue components `async` code

    Using composables, write less code in Vue component, and everything in composables can be reused in other components

    Composable function is equivalent to Service class in PHP/Laravel, while a Vue component is using the Service
    method, like Laravel Controller

    Ref means reference which will make variables exposed from posts composable function reactive and stateful

    By convention, composable function names start with "use", we name this composable function:usePosts

    Use `async` with composable function to fetch DB posts only with `<script setup>` instead of `<script>` for
    component:PostsIndex2

    To better import files and instead of going back directories with dots `../../` , we can use shortcut: `@`
    as alias defined inside vite.config.js:
    import usePosts from "../../composables/posts";
    mport usePosts from "@/composables/posts";

    When using Options API, composable functions must be called inside setup(), and returned bindings must also be
    returned from setup() so that composable functions reactive data is exposed to `this` context in Vue template


    https://vuejs.org/api/composition-api-setup.html
    https://vuejs.org/guide/reusability/composables.html

*/
