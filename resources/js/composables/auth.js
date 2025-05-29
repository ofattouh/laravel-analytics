import { ref, reactive, inject } from 'vue';

// Composable reusable function
export default function useAuth() {
    const processing = ref(false);
    const user = ref({});
    const isUserFound = ref(false);

    // Define sweetalert package variable
    const swal = inject('$swal');

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

    // Get logged-in user info
    const getLoggedUser = async () => {
        await axios.get('/user-info')
            .then(response => {
                // console.log('\nresponse: ', response.data);

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

    // Get logged-in user role
    const getUserRole = async () => {
        await axios.get('/user-role')
            .then(response => {
                // console.log('\nresponse: ', response.data);

                // User record was found
                if (response && response.data.userRole && response.data.userPermissions) {
                    user.value.role = response.data.userRole;
                    user.value.permissions = response.data.userPermissions;
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

    return { processing, isUserFound, user, logout, getLoggedUser, getUserRole }
}

/*

    // https://casl.js.org/v6/en/
    // https://casl.js.org/v6/en/guide/intro

    import { AbilityBuilder, Ability } from '@casl/ability';
    import { ABILITY_TOKEN } from '@casl/vue';

    const ability = inject(ABILITY_TOKEN);

    // Called from API endoint:abilities defined in routes/api.php
    const getAbilities = async() => {
        axios.get('/api/abilities')
            .then(response => {
                const permissions = response.data;

                const { can, rules } = new AbilityBuilder(Ability);
                can(permissions);
                ability.update(rules);
            })
    }

    const loginUser = async (response) => {
        user.name = response.data.name;
        user.email = response.data.email;

        await getAbilities();
        await router.push({ name: 'posts.index' });
    }


    https://plainenglish.io/community/how-to-reload-a-page-in-vue-js-419508
*/
