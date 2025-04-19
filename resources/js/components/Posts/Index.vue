<script>
    export default {
        data() {
            return {
                // Store PostController table:posts DB values and initialize it to empty array
                posts: []
            }
        },
        mounted() {
            // When `PostsIndex` component is mounted/initialized, call this method from this component
            this.fetchPosts()
        },
        methods: {
            // Create GET request to: `/api/posts` to fetch DB posts using PostController index method
            fetchPosts() {
                axios.get('/api/posts')
                    .then(response => this.posts = response.data)   // if request is successful, store posts
                    .catch(error => console.log(error))             // if request has error, log error
            }
        }
    }
</script>

<template>
    <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200">
        <div class="min-w-full align-middle">
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Updated at</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 divide-solid">

                    <!-- Loop through posts variable passed in from Vue component data() in script tag -->
                    <tr v-bind:key="post" v-for="post in posts">
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.id }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.title }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.text }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.category_id }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<!--

    Every Vue component consists of two parts: script and template tags

    To initialize Vue app, add `PostsIndex` component and mount it to top app HTML element in resources/js/app.js

    Inside Vue components: initialize variables in data(), add custom functions in methods, call these
    custom methods in mounted() immediately after component is initialized/mounted

    We name component `PostsIndex` because it is component for Posts and Index.vue file. however for calling
    components in Vue files, there are 2 ways that Vue.js supports: using `kebab-used` (used in Vue template files)
    and PascalCase (For components naming as per the style guide)

    Compile Vue template file manually by running:`npm run build` everytime to reflect Vue file code changes OR

    Run `npm run dev` in the background and build assets only when there are template changes. And with Vite,
    after every recompile browser will be refreshed automatically

    Tailwind doesn't pick up CSS/HTML in Vue template. We must add Vue components location to Tailwind config file:
    tailwind.config.js: so that it would automatically detect and compile CSS/HTML changes in Vue template

    NO need to run: `npm run dev` separately because Laravel:`composer run dev` is already running on separate terminal

    Show all DB posts in Vue template from table:Posts using `v-for` Vue directive


    https://laraveldaily.com/lesson/vue-laravel-vite-spa-crud/spa-install-laravel-vue-first-vuejs-component
-->
