<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table border p-4 w-full">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="p-3">
                            @foreach ($users as $user)
                                <tr class="border">
                                    <td class="text-center px-3 py-3">{{ $user->id }}</td>
                                    <td class="text-center px-3 py-3">{{ $user->name }}</td>
                                    <td class="text-center px-3 py-3">{{ $user->email }}</td>
                                    <td class="text-center px-3 py-3" id="user-{{ $user->id }}">Inactive</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        let userId = @json(Auth::user()->id);
        Echo.channel('activity').listen('UserStatus', (e) => {
            let userId = e.user_id;
            let status = e.status;
            console.log(e);
            $(`#user-${userId}`).text(status.toUpperCase());
        });
    </script>
</x-app-layout>
