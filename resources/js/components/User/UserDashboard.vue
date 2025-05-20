<template>
    <h2 class="font-semibold text-gray-800 leading-tight">
        TalentLMS API
    </h2>

    <!-- API Key -->
    <div>
        <br>
        <label for="api-key" class="block text-sm font-medium text-gray-700">API KEY</label>
        <input id="api-key" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

        <!-- Validation Errors -->
        <div class="text-red-600 mt-1">
            <div v-bind:key="message" v-for="message in validationErrors?.title">
                {{ message }}
            </div>
        </div>
    </div>

    <!-- API End Point -->
    <div>
        <br>
        <label for="api-endpoint" class="block text-sm font-medium text-gray-700">API END POINT</label>
        <input id="api-endpoint" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

        <!-- Validation Errors -->
        <div class="text-red-600 mt-1">
            <div v-bind:key="message" v-for="message in validationErrors?.title">
                {{ message }}
            </div>
        </div>
    </div>
</template>
