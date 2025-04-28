<script setup>
    import { onMounted, ref, watch } from "vue";
    import { TailwindPagination } from 'laravel-vue-pagination';

    // import usePosts from "../../composables/posts";
    import usePosts from "@/composables/posts";
    import useCategories from "@/composables/categories";

    // Store reference
    const selectedCategory = ref('')

    // Composable function:usePosts expose all data
    const { posts, getPosts } = usePosts()

    // Composable function:useCategories expose all data
    const { categories, getCategories } = useCategories()

    // Watch `selectedCategory` variable for changes of two values: current and previous
    // Pass page number and current value of selected category as arguments to getPosts()
    watch(selectedCategory, (current, previous) => {
        getPosts(1, current)
    })

    // called only when component finish loading
    onMounted(() => {
        getPosts()
        getCategories()
    })
</script>

<template>
    <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200">
        <div class="min-w-full align-middle">

            <!-- Add Vue Composable:categories to show all categories -->
            <!-- Loop through categories stateful reactive variable passed from Vue composable function:useCategories -->
            <div class="mb-4">
                <select v-model="selectedCategory" class="block mt-1 w-full sm:w-1/4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" selected>-- Filter by category --</option>
                    <option v-bind:key="category.id" v-for="category in categories.data" :value="category.id" >
                        {{ category.name }}
                    </option>
                </select>
            </div>

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
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created at</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Updated at</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 divide-solid">

                    <!-- Add Vue Composable:posts to show all Posts -->
                    <!-- Loop through posts stateful reactive variable passed from Vue composable function:usePosts -->
                    <tr v-bind:key="post.id" v-for="post in posts.data">
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.id }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.title }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.category_name }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.text }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.created_at }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ post.updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tailwind pagination links, Limit should match `numberRecords` of Api/PostController:index method,
                Pass page number and selected category to getPosts() method to fix pagination -->
            <TailwindPagination
                :data="posts"
                :limit="10"
                :keepLength="true"
                class="mt-4"
                @pagination-change-page="page => getPosts(page, selectedCategory)"
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
