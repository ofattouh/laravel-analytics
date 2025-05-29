<script setup>
    import { onMounted } from "vue";

    // reusable composable component
    import useAuth from '@/composables/auth';

    // Composable component used for login authentication purposes
    const { user, getLoggedUser, getUserRole } = useAuth();

    // called only when component finish loading
    onMounted(() => {
        getLoggedUser()
        getUserRole()
    })
</script>

<template>
    <h2 class="font-semibold text-gray-800 leading-tight">
        TalentLMS Integration
    </h2>

    <!-- Show xAPI settings ONLY to users with role:administrator -->
    <div v-bind:key="user.role" v-if="user.role == 'Administrator'">
        <!-- xAPI End Point -->
        <div>
            <br>
            <label for="xapi-endpoint" class="block text-sm font-medium text-gray-700">xAPI Endpoint</label>
            <input id="xapi-endpoint" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            <!-- Validation Errors -->
            <div class="text-red-600 mt-1">
                <div v-bind:key="message" v-for="message in validationErrors?.title">
                    {{ message }}
                </div>
            </div>
        </div>


        <!-- xAPI Key -->
        <div>
            <br>
            <label for="xapi-key" class="block text-sm font-medium text-gray-700">xAPI Key</label>
            <input id="xapi-key" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            <!-- Validation Errors -->
            <div class="text-red-600 mt-1">
                <div v-bind:key="message" v-for="message in validationErrors?.title">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- xAPI Secret -->
        <div>
            <br>
            <label for="xapi-secret" class="block text-sm font-medium text-gray-700">xAPI Secret</label>
            <input id="xapi-secret" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            <!-- Validation Errors -->
            <div class="text-red-600 mt-1">
                <div v-bind:key="message" v-for="message in validationErrors?.title">
                    {{ message }}
                </div>
            </div>
        </div>
    </div>

    <!-- TalentLMS API Data is shown for all logged in users with any role -->
    <br>
    <div>
        <a href="/" class="my-dashboard-link">Fetch API Data</a>
    </div>

</template>

<style>

    .my-dashboard-link {
        text-decoration: underline;
        color: #7a2531;
    }

</style>
