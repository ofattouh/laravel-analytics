<script setup>
    import { onMounted } from "vue";
    import { TailwindPagination } from 'laravel-vue-pagination';

    // import useProducts from "../../composables/products";
    import useProducts from "@/composables/products";

    // Composable function:useProducts expose all data and methods
    const { products, getProducts } = useProducts();

    // called only when component finish loading
    onMounted(() => {
        getProducts();
    })
</script>

<template>
    <div class="grid grid-cols-3 gap-3">
        <div class="space-y-2" v-for="product in products.data" v-bind:key="product.id">
            <a href="#"><img src="https://dummyimage.com/300x200/dee2e6/6c757d.jpg" :alt="product.name" /></a>

            <p><b>Product:</b> <a class="text-slate-500 text-xl font-semibold hover:underline">{{ product.name }}</a></p>

            <p><b>ID:</b> {{ product.id }}</p>

            <p><b>Category:</b> {{ product.category.name }}</p>

            <p><b>Price:</b> ${{ product.price }}</p>

            <p class="prose-slate">{{ product.description }}</p>
        </div>
    </div>

    <!-- Tailwind pagination links,limit should match `numberRecords` in Api/ProductController -->
    <TailwindPagination
        :data="products"
        :limit="6"
        :keepLength="true"
        class="mt-4"
        @pagination-change-page="page => getProducts(page)"
    />

</template>

<!--


    https://laravel-vue-pagination.org/
-->
