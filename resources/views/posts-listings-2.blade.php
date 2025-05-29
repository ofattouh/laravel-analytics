<x-app-layout>
    <x-slot name="header">
        <!-- Display Vue component -->
        <app-navigation></app-navigation>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display component using Vue 3 Composition API and Composable function to show DB Posts -->
                    <posts-index-2></posts-index-2>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!--
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
-->
