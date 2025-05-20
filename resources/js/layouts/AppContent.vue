<script setup>
    import { useRoute } from 'vue-router';
</script>

<template>
    <div>


        <!-- Dynamic Page Content (only this part is auto refreshed) -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<style>

    /* Active menu item border width */
    .my-bolder-width {
        border-bottom-width: 2px;
    }

    /* Custom color style */
    .my-color-burgundy {
        border-color: #7a2531;
    }

</style>

<!--

    This is Vue root/main component which has HTML main layout

    `<router-link>`,`<router-view>` defined in `<vue-router>` are replacing HTML anchor links which once clicked,
    will not refresh the full page, but only refresh the part inside of `<router-view>' which is SPA behavior

    `<router-view>` element is where all the main dynamic content will be loaded

    By defining/binding routes :to names, if route path is changed, we only need to change path in 1 file

    To access route `meta`:`title` variable,use composable component:routes to get route `meta` with `title`


-->
