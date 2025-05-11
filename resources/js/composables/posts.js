import { ref } from 'vue'
import { useRouter } from 'vue-router'

// Composable reusable function
export default function usePosts() {
    // Store objects references
    const posts = ref({});
    const post = ref({})

    // vue-router Composable component
    const router = useRouter()

    const validationErrors = ref({})
    const isLoading = ref(false) // default:false

    // Get single post from Vue Edit component
    const getPost = async (id) => {
        await axios.get('/api/posts/' + id)
            .then(response => {
                post.value = response.data.data;
            })
    }

    const getPosts = async (
        page = 1,
        category = '',
        order_column = 'updated_at',
        order_direction = 'desc'
    ) => {
        // Paginated, sorted data returned from API call
        const response = await axios.get('/api/posts', {
            params: {
                page: page,
                category: category,
                order_column: order_column,
                order_direction: order_direction
            }
        });

        posts.value = response.data;
    }

    const storePost = async (post) => {
        // don't submit the form twice
        if (isLoading.value) return;

        // Continue processing and reset errors
        isLoading.value = true;
        validationErrors.value = {};

        // Serialize and store post data
        let serializedPost = new FormData();

        for (let item in post) {
            if (post.hasOwnProperty(item)) {
                serializedPost.append(item, post[item])
            }
        }


        // Save post to DB from this API call triggered from Form submit method of Vue component:Posts/Create.vue
        await axios.post('/api/posts', serializedPost)
            .then(response => {
                // After submiting form,redirect users to posts index2 page using push() method from vue-router Composable
                router.push({ name: 'posts.index2' });;
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors; // Save errors
                    isLoading.value = false // Allow resubmiting form because of validation errors
                }
            })
    }

    // Update single post from Vue Edit component
    const updatePost = async (post) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        await axios.put('/api/posts/' + post.id, post)
            .then(response => {
                router.push({ name: 'posts.index2' })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    // Return exposed reactive stateful data and methods
    return { posts, post, getPosts, getPost, storePost, updatePost, validationErrors, isLoading }
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
    import usePosts from "@/composables/posts";

    When using Options API, composable functions must be called inside setup(), and returned bindings must also be
    returned from setup() so that composable functions reactive data is exposed to `this` context in Vue template

    If form takes longer to submit, we need loading indicator,disable submit button so user wouldn't hit it twice.


    const posts = ref([])

    const getPosts = async () => {
        axios.get('/api/posts').then(response => {
            // Added extra `data` wrapper from Eloquent API Resource call: `PostResource`:`toArray` method
            posts.value = response.data.data;
        })
    }

    const getResults = async (page = 1) => {
        const response = await fetch(`https://example.com/results?page=${page}`);
        laravelData.value = await response.json();
    }

    // Paginated, sorted data returned from API call
    const response = await axios.get('/api/posts?' +
        'page=' + page +
        '&category=' + category +
        '&order_column=' + order_column +
        '&order_direction=' + order_direction
    );


    https://laravel-vue-pagination.org/
    https://vuejs.org/api/composition-api-setup.html
    https://vuejs.org/guide/reusability/composables.html

    https://axios-http.com/docs/req_config

*/
