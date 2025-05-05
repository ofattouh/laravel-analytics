<script setup>
    import { onMounted, reactive} from 'vue';

    // import Vue composables reusable components
    import useCategories from '@/composables/categories';
    import usePosts from '@/composables/posts';

    // Get reactive stateful data,method using Composable component:useCategories
    const { categories, getCategories } = useCategories();

    // Get reactive stateful method using Composable component:usePosts
    const { storePost } = usePosts();

    // `post` parameters needs to be reactive object for `storePost(post)` method
    const post = reactive({
        title: '',
        text: '',
        category_id: '',
    })

    onMounted(() => {
        getCategories();
    })
</script>

<template>
    <form @submit.prevent="storePost(post)">

        <!-- Title -->
        <div>
            <label for="post-title" class="block text-sm font-medium text-gray-700">Title</label>
            <input v-model="post.title" id="post-title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <!-- Content -->
        <div class="mt-4">
            <label for="post-content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea v-model="post.text" id="post-content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>

        <!-- Category -->
        <div class="mt-4">
            <label for="post-category" class="block text-sm font-medium text-gray-700">Category</label>

            <!-- Add Vue Composable:categories to show all categories -->
            <!-- Loop through stateful reactive variable:categories passed in from Vue composable:useCategories -->
            <select v-model="post.category_id" id="post-category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="" selected>-- Please select category --</option>
                <option v-bind:key="category.id" v-for="category in categories.data" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <button class="rounded-md my-bgcolor-burgundy px-3 py-2 text-sm uppercase text-white">Save</button>
        </div>
    </form>
</template>

<style>

     /* Custom color style */
    .my-bgcolor-burgundy {
        background-color: #7a2531;
    }

</style>

<!--

    `v-model` Directive adds two-way data binding for HTML fields

-->
