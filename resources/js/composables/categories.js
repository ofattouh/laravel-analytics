import { ref } from 'vue'

// Composable reusable function
export default function useCategories() {
    // Store object reference
    const categories = ref({});

    const getCategories = async () => {
        // Data returned from API call
        const response = await axios.get('/api/categories');
        categories.value = response.data;
    }

    // Return exposed reactive stateful data:`categories` and exposed method:`getCategories`
    return { categories, getCategories }
}


/*

    https://vuejs.org/api/composition-api-setup.html
    https://vuejs.org/guide/reusability/composables.html
*/
