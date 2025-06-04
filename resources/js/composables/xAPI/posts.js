import { ref } from 'vue'

// Composable reusable function
export default function usePosts() {
    // Store object reference
    const posts = ref({});

    const getPosts = async () => {
        // Data returned from API call
        const response = await axios.get('/api/xapiposts');
        posts.value = response.data;
    }

    // Return exposed reactive stateful data:`posts` and exposed method:`getPosts`
    return { posts, getPosts }
}


/*

    https://vuejs.org/api/composition-api-setup.html
    https://vuejs.org/guide/reusability/composables.html
*/
