<x-app-layout>
    <x-slot name="header">
        <!-- Display Vue component -->
        <app-navigation></app-navigation>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2>
                        {{ __('Page is not found!') }} <br><br>
                        {{ __('Please enter correct page URL')}} <br><br>

                        @auth
                            <!-- Hyperlink ONLY shown for Guests -->
                        @else
                            <a href="/"><span style="text-decoration: underline;">Evaluation App<span></a>
                        @endauth
                    </h2>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
