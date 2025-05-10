<script setup>
    import { onMounted, reactive} from 'vue';

    // import Vue composables reusable components
    import useCategories from '@/composables/categories';
    import usePosts from '@/composables/posts';

    // Get reactive stateful data,method using Composable component:useCategories
    const { categories, getCategories } = useCategories();

    // Get reactive stateful data, method using Composable component:usePosts
    const { storePost, validationErrors, isLoading } = usePosts();

    // `post` parameters needs to be reactive object for `storePost(post)` method
    const post = reactive({
        title: '',
        text: '',
        category_id: '',
        thumbnail: ''
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

            <!-- Validation Errors -->
            <div class="text-red-600 mt-1">
                <div v-bind:key="message" v-for="message in validationErrors?.title">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="mt-4">
            <label for="post-content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea v-model="post.text" id="post-content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>

            <!-- Validation Errors -->
            <div class="text-red-600 mt-1">
                <div v-bind:key="message" v-for="message in validationErrors?.text">
                    {{ message }}
                </div>
            </div>
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

            <!-- Validation Errors -->
            <div class="text-red-600 mt-1">
                <div v-bind:key="message" v-for="message in validationErrors?.category_id">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- File input: Thumbnail -->
        <div class="mt-4">
            <label for="thumbnail" class="block font-medium text-sm text-gray-700">Thumbnail</label>
            <input type="file" id="thumbnail" @change="post.thumbnail = $event.target.files[0]" />

            <!-- Validation Errors -->
            <div class="text-red-600 mt-1">
                <div v-bind:key="message" v-for="message in validationErrors?.thumbnail">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <!-- Bind disabled attribute to isLoading variable -->
            <button :disabled="isLoading" class="inline-flex items-center rounded-md my-bgcolor-burgundy px-3 py-2 text-sm uppercase text-white disabled:opacity-75 disabled:cursor-not-allowed">
                <span v-show="isLoading" class="inline-block animate-spin w-4 h-4 mr-2 border-t-2 border-t-white border-r-2 border-r-white border-b-2 border-b-white border-l-2 border-l-blue-600 rounded-full"></span>
                <span v-if="isLoading">Processing...</span>
                <span v-else>Save</span>
            </button>
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

    File input can not use `v-model`,instead listen for @change event, and select first file from array


-->
