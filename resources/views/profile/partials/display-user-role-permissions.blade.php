<section>
    <div>
        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Account Permissions') }}
        </h2>

        <!-- User Role -->
        <br>
        <div>
            <h2 class="text-medium text-gray-900">
                {{ __('User Role') }}
            </h2>

            <p class="mt-2 font-medium text-sm text-gray-800">
                {{ $userRole }}
            </p>
        </div>

        <!-- User Permissions -->
        <br>
        <div>
            <h2 class="text-medium text-gray-900">
                {{ __('User Permissions') }}
            </h2>

            <table>
                @for ($i = 0; $i < count($userPermissions); $i++)
                    <tr>
                        <td>
                            <p class="mt-2 font-medium text-sm text-gray-800">
                                {{ $userPermissions[$i]['name'] }}{{': '}}
                            </p>
                        </td>

                        <td>
                            <p class="mt-2 font-medium text-sm text-gray-800">
                                {{ $userPermissions[$i]['description'] }}
                            </p>
                        </td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>
</section>
