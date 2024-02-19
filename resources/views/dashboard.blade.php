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
        function sendRequest() {
            // Retrieve CSRF token value from meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request with CSRF token
            $.ajax({
                url: "{{ route('trace-status') }}",
                method: 'POST', // or 'GET' depending on your controller route
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('AJAX request error:', error);
                }
            });
        }

        // Send AJAX request every 5 seconds
        setInterval(sendRequest, 5000); // 5000 milliseconds = 5 seconds
        window.Echo.channel('activity').listen('UserStatus', (e) => {
            let userId = e.user_id;
            let status = e.status;
            console.log(e);
            $(`#user-${userId}`).text(status.toUpperCase());
        });
    </script>
</x-app-layout>
