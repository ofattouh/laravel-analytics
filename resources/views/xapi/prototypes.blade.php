<x-app-layout>
    <!-- Display Vue component
    <x-slot name="header">
        <app-navigation></app-navigation>
    </x-slot>
    -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @php
                        // echo "<br>profileId: ".$profileId;
                        // echo "<br>activityId: ".$activityId;
                    @endphp

                    <!-- Display component using Vue 2 Options API to show xAPI Posts -->
                    <xapi-posts-index></xapi-posts-index>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!--

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Posts Listings') }}
    </h2>

-->
