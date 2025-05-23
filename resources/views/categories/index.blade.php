<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Go to create method of Controller:CategoryController -->
                    <a href="{{ route('categories.create') }}">Add new category</a>
                    <br><br>

                    @if (sizeof($categories) > 0)
                        <table style="border: 1px solid black;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <!-- foreach loop CategoryController variable $categories passed from index method using Route Model binding -->
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <!-- Go to CategoryController edit method, pass category using route model binding -->
                                            <a href="{{ route('categories.edit', $category) }}">Edit</a>

                                            <!-- POST variable:$category to Controller:CategoryController destroy() method  -->
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
