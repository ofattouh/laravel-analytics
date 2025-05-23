import { ref, reactive, inject } from 'vue';

// Composable reusable function
export default function useAuth() {
    const processing = ref(false);
    const user = ref({});
    const isUserFound = ref(false);

    // Define sweetalert package variable
    const swal = inject('$swal');

    // Get logged user info
    const getLoggedUser = async () => {
        await axios.get('/userinfo')
            .then(response => {
                // console.log('\nresponse: ', response);

                // User record was found
                if (response && (response.data.name || response.data.email)) {
                    user.value.name = response.data.name;
                    user.value.email = response.data.email;
                    isUserFound.value = true;
                }
            })
            .catch(error => {
                swal({
                    icon: 'error',
                    title: error.response.statusText,
                    text: error.message,
                })
            })
    }

    // Logout user when logout button in AppNavigation.vue is clicked
    const logout = async () => {
        if (processing.value) return;

        processing.value = true;

        axios.post('/logout')
            .then(response =>  {
                // can't redirect because `vue-router` routing and Laravel routes/web.php routing conflict
                // router.push({ path: '/' });
                window.location.href = "/";
            })
            .catch(error => {
                swal({
                    icon: 'error',
                    title: error.response.statusText,
                    text: error.message,
                })
            })
            .finally(() => {
                processing.value = false

        })
    }

    return { processing, isUserFound, user, logout, getLoggedUser }
}

/*

    https://plainenglish.io/community/how-to-reload-a-page-in-vue-js-419508
*/
