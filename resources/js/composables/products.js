import { ref } from 'vue';

// Composable reusable function
export default function useProducts() {

    // Store object reference
    const products = ref({});

    // Paginate data returned from API call `Api/ProductController` index method and using route:`products`
    const getProducts = async (page = 1) => {
        const response = await axios.get('/api/products', {
            params: {
                page: page,
            }
        }).catch((error) => console.log(error));

        products.value = await response.data;
        // console.log('response:', response.data);
    }

    // Return exposed reactive stateful data and methods
    return { products, getProducts }
}
