<x-app-layout>
    <x-slot name="header">
        <!-- Display component using Vue 3 -->
        <app-navigation></app-navigation>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display component using Vue 3 -->
                    <products-index></products-index>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- Laravel navigation Links --}}
{{-- $products->links() --}}
