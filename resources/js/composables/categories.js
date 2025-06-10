import { ref } from 'vue';

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

    // Create Category using Vue HTML Form where category `name` is text input field in Vue template
    <script setup>
        import { ref } from 'vue';
        const name = ref(''); // Store string reference

        // Button is clicked from Vue template
        const submit = () => {
            axios.post('/api/categories', {
                name: name.value,
            })
            .then(response => {
                console.log('New Category ID: ' + response.data.data.id)
            })
        }
    </script>


    https://vuejs.org/api/composition-api-setup.html
    https://vuejs.org/guide/reusability/composables.html
*/
