<script setup>
    import { onMounted } from 'vue';

    // reusable composable component
    import useAuth from '@/composables/auth';

    // Composable component used for login authentication purposes
    const { processing, isUserFound, user, logout, getLoggedUser,  getUserRole } = useAuth();

    // Component is ready and mounted
    onMounted(() => {
        getLoggedUser()
        getUserRole()
    })
</script>

<template>
    <!-- Navigation section ONLY shown for logged in user -->
    <div v-show="isUserFound">

        <!-- Primary Navigation Top Menu -->
        <nav class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">

                        <!-- Platform Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="/">
                                <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="block h-9 w-auto fill-current text-gray-800">
                                    <path d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205ZM244.75 114.995V164.795L226.39 154.225L201.03 139.625V89.825L219.39 100.395L244.75 114.995ZM249.12 57.105L292.81 82.265L249.12 107.425L205.43 82.265L249.12 57.105ZM114.49 184.425L96.13 194.995V85.305L121.49 70.705L139.85 60.135V169.815L114.49 184.425ZM91.76 27.425L135.45 52.585L91.76 77.745L48.07 52.585L91.76 27.425ZM43.67 60.135L62.03 70.705L87.39 85.305V202.545V202.555V202.565C87.39 202.735 87.44 202.895 87.46 203.055C87.49 203.265 87.49 203.485 87.55 203.695V203.705C87.6 203.875 87.69 204.035 87.76 204.195C87.84 204.375 87.89 204.575 87.99 204.745C87.99 204.745 87.99 204.755 88 204.755C88.09 204.905 88.22 205.035 88.33 205.175C88.45 205.335 88.55 205.495 88.69 205.635L88.7 205.645C88.82 205.765 88.98 205.855 89.12 205.965C89.28 206.085 89.42 206.225 89.59 206.325C89.6 206.325 89.6 206.325 89.61 206.335C89.62 206.335 89.62 206.345 89.63 206.345L139.87 234.775V285.065L43.67 229.705V60.135ZM244.75 229.705L148.58 285.075V234.775L219.8 194.115L244.75 179.875V229.705ZM297.2 139.625L253.49 164.795V114.995L278.85 100.395L297.21 89.825V139.625H297.2Z"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Navigation Menu Hyperlinks -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="/user/dashboard" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
                                DASHBOARD
                            </a>

                            <a href="/posts/create" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
                                SAVE DATA
                            </a>

                            <a href="/posts/index" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
                                DEMO DATA
                            </a>

                            <a href="/posts/index2" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
                                DEMO DATA 2
                            </a>

                            <a href="/profile" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
                                MY ACCOUNT
                            </a>
                        </div>
                    </div>

                    <!-- Logged in user info -->
                    <div class="flex items-center">
                        <div class="flex">
                            <div>
                                <div>Hi, {{ user.name }}</div>
                                <div class="text-sm text-gray-500">{{ user.email }}</div>
                            </div>
                        </div>

                        <div>
                            <button @click="logout" type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4"
                                :class="{ 'opacity-25': processing }"
                                :disabled="processing">
                                Log out
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<style>

    /* Custom color style */
    .my-color-burgundy {
        border-color: #7a2531;
    }

</style>

<!--

    This is Vue component which has HTML shared navigation layout

    `<router-link>`,`<router-view>` defined in `<vue-router>` are replacing HTML anchor links which once clicked,
    will not refresh the full page, but only refresh the part inside of `<router-view>' which is SPA behavior

    `<router-view>` element is where all the main dynamic content will be loaded

    By defining/binding routes `:to` names, if route path is changed, we only need to change path in 1 file

    To access route `meta`:`title` variable,use composable component:routes to get route `meta` with `title`

    // IMPORTANT:
    Had to change navigation links from `router-link` to hyperlinks because `vue-router` routing conflicts with
    Laravel routes/web.php routing,and router.push() no longer redirects to other routes because of this change

    // The underline shown below each active link is created by adding these classes to active-class
    <router-link :to="{ name: 'user.dashboard' }" active-class="my-bolder-width my-color-burgundy" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
        DASHBOARD
    </router-link>

    <router-link :to="{ name: 'posts.create' }" active-class="my-bolder-width my-color-burgundy" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
        CREATE POST
    </router-link>

    <router-link :to="{ name: 'posts.index' }" active-class="my-bolder-width my-color-burgundy" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
        DISPLAY POSTS
    </router-link>

    <router-link :to="{ name: 'posts.index2' }" active-class="my-bolder-width my-color-burgundy" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
        DISPLAY POSTS
    </router-link>

    <router-link :to="{ name: 'user.profile' }" active-class="my-bolder-width my-color-burgundy" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:my-color-burgundy transition duration-150 ease-in-out">
        MY ACCOUNT
    </router-link>


    // import { computed, onMounted } from 'vue';
    // import { useRoute } from 'vue-router';

    // Composable component:route (Starts with the word use)
    // const route = useRoute();

    // Dynamic reactive property:`title` is exposed using Composable component:route
    // const currentPageTitle = computed(() => route.meta.title);

    // Page Header
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold my-color-burgundy">
                {{ currentPageTitle }}
            </h2>
        </div>
    </header>

    /* Active menu item border width */
    .my-bolder-width {
        border-bottom-width: 2px;
    }

-->
