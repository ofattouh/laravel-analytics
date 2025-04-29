<script setup>
    import { onMounted, ref, watch } from "vue";
    import { TailwindPagination } from 'laravel-vue-pagination';

    // import usePosts from "../../composables/posts";
    import usePosts from "@/composables/posts";
    import useCategories from "@/composables/categories";

    // Store reference to selected category
    const selectedCategory = ref('')

    // Store reference to sorting default parameters
    const orderColumn = ref('updated_at')
    const orderDirection = ref('desc')

    // Composable function:usePosts expose all data
    const { posts, getPosts } = usePosts()

    // Composable function:useCategories expose all data
    const { categories, getCategories } = useCategories()

    // Update sorted column: By default, table is ordered by `updated_at` field in `desc` order
    const updateOrdering = (column) => {
        orderColumn.value = column
        orderDirection.value = (orderDirection.value === 'asc') ? 'desc' : 'asc' // Toggle value
        getPosts(1, selectedCategory.value, orderColumn.value, orderDirection.value)
    }

    // Watch `selectedCategory` variable for changes of two values: current and previous
    // Pass page number, current selectedCategory, orderColumn, orderDirection to getPosts()
    watch(selectedCategory, (current, previous) => {
        getPosts(1, current, orderColumn.value, orderDirection.value)
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
                <span class="my-color-burgundy">Filter by Category</span>

                <select v-model="selectedCategory" class="block mt-1 w-full sm:w-1/4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" selected>-- Please select value --</option>
                    <option v-bind:key="category.id" v-for="category in categories.data" :value="category.id" >
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <!-- Add up/down arrows to table column headings, to show sorting directions -->
                            <div class="flex flex-row items-center justify-between cursor-pointer" @click="updateOrdering('id')">

                                <!-- If orderColumn is equal to ordered column,change text to bold,colored using :class binding -->
                                <div class="leading-4 font-medium text-gray-500 uppercase tracking-wider" :class="{ 'font-bold my-color-burgundy': orderColumn === 'id' }">
                                    ID
                                </div>

                                <!-- Check order direction and order column to either show/hide the arrow -->
                                <div class="select-none">
                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'asc' && orderColumn === 'id',
                                        'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'id',
                                    }">&uarr;</span>

                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'desc' && orderColumn === 'id',
                                        'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'id',
                                    }">&darr;</span>
                                </div>
                            </div>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <!-- Add up/down arrows to table column headings, to show sorting directions -->
                            <div class="flex flex-row items-center justify-between cursor-pointer" @click="updateOrdering('title')">

                                <!-- If orderColumn is equal to ordered column,change text to bold,colored using :class binding -->
                                <div class="leading-4 font-medium text-gray-500 uppercase tracking-wider" :class="{ 'font-bold my-color-burgundy': orderColumn === 'title' }">
                                    Title
                                </div>

                                <!-- Check order direction and order column to either show/hide the arrow -->
                                <div class="select-none">
                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'asc' && orderColumn === 'title',
                                        'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'title',
                                    }">&uarr;</span>

                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'desc' && orderColumn === 'title',
                                        'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'title',
                                    }">&darr;</span>
                                </div>
                            </div>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <!-- Add up/down arrows to table column headings, to show sorting directions -->
                            <div class="flex flex-row items-center justify-between cursor-pointer" @click="updateOrdering('created_at')">

                                <!-- If orderColumn is equal to ordered column,change text to bold,colored using :class binding -->
                                <div class="leading-4 font-medium text-gray-500 uppercase tracking-wider" :class="{ 'font-bold my-color-burgundy': orderColumn === 'created_at' }">
                                    Created at
                                </div>

                                <!-- Check order direction and order column to either show/hide the arrow -->
                                <div class="select-none">
                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'asc' && orderColumn === 'created_at',
                                        'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'created_at',
                                    }">&uarr;</span>

                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'desc' && orderColumn === 'created_at',
                                        'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'created_at',
                                    }">&darr;</span>
                                </div>
                            </div>
                        </th>

                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <!-- Add up/down arrows to table column headings, to show sorting directions -->
                            <div class="flex flex-row items-center justify-between cursor-pointer" @click="updateOrdering('updated_at')">

                                <!-- If orderColumn is equal to ordered column,change text to bold,colored using :class binding -->
                                <div class="leading-4 font-medium text-gray-500 uppercase tracking-wider" :class="{ 'font-bold my-color-burgundy': orderColumn === 'updated_at' }">
                                    Updated at
                                </div>

                                <!-- Check order direction and order column to either show/hide the arrow -->
                                <div class="select-none">
                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'asc' && orderColumn === 'updated_at',
                                        'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'updated_at',
                                    }">&uarr;</span>

                                    <span :class="{
                                        'my-color-burgundy': orderDirection === 'desc' && orderColumn === 'updated_at',
                                        'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'updated_at',
                                    }">&darr;</span>
                                </div>
                            </div>
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
                Pass page number,selected category,order column,order direction to getPosts to fix pagination -->
            <TailwindPagination
                :data="posts"
                :limit="10"
                :keepLength="true"
                class="mt-4"
                @pagination-change-page="page => getPosts(page, selectedCategory, orderColumn, orderDirection)"
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

    /* Custom color style */
    .my-color-burgundy {
        color: #7a2531;
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
