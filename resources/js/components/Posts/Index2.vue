<script setup>
    import { onMounted } from "vue";
    import { TailwindPagination } from 'laravel-vue-pagination';

    // import usePosts from "../../composables/posts";
    import usePosts from "@/composables/posts";

    // Composable function:usePosts expose all data
    const { posts, getPosts } = usePosts()

    // called only when component finish loading
    onMounted(() => {
        getPosts()
    })
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

                    <!-- Loop through posts stateful reactive variable passed from Vue composable function:usePosts -->
                    <!-- Change posts to posts.data for Laravel Vue Pagination library -->
                    <tr v-bind:key="post" v-for="post in posts.data">
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
            <br>

            <!-- Tailwind pagination links, Limit match numberRecords of PostController:index method -->
            <TailwindPagination
                :data="posts"
                :limit="10"
                :keepLength="true"
                @pagination-change-page="getPosts"
            />
        </div>
    </div>
</template>

<style>

    /* Laravel Vue Pagination styling for active pagination item (active-classes) */
    .bg-blue-50, .border-blue-500, .text-blue-600 {
        border-color: #7a2531;
        background-color: #7a2531;
        color: #FFF;
    }

    /* Laravel Vue Pagination styling for each pagination item (item-classes)
    .bg-white, text-gray-500, border-gray-300,hover:bg-gray-50 {

    }
    */

</style>


<!--

    This component uses: Vue 3 Composition API and Composable function

    <TailwindPagination
        :data="posts"
        :class="['bg-blue-50', 'border-blue-500','text-blue-600',]"
        @pagination-change-page="getPosts"
    />


    https://laravel-vue-pagination.org/guide/components/tailwind.html
    https://laravel-vue-pagination.org/guide/api/props.html

    https://github.com/peshanghiwa/vue-awesome-paginate

-->
