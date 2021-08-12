<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message/>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Birth Date</th>
                                <th scope="col">Age</th>
                                <th scope="col">City</th>
                                <th scope="col">
                                        <!-- create button -->
                                        <a href="{{ route('users.create') }}">
                                            <x-button class="ml-3 bg-green-500">
                                                {{ __('New User') }}
                                            </x-button>
                                        </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->cedula }}</td>
                                    <td>{{ $user->birth_date->format('d/m/Y') }}</td>
                                    <td>{{ $user->birth_date->age }}</td>
                                    <td>{{ $user->city->name }}</td>
                                    <td>
                                        <!-- edit button -->
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">
                                            <x-button class="ml-3" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002
                                                        2h11a2 2 0 002-2v-5m-1.414-9.414a2 2
                                                        0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                    />
                                                </svg>
                                            </x-button>
                                        </a>

                                        @if (! $user->isAdmin())
                                            <!-- destroy button -->
                                            <x-button class="ml-3 bg-red-500" title="Delete"
                                                type='button' onclick="clickDestroy(event, 'delete-{{ $user->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138
                                                        21H7.862a2 2 0 01-1.995-1.858L5 7m5
                                                        4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1
                                                        1 0 00-1 1v3M4 7h16"
                                                    />
                                                </svg>
                                            </x-button>
                                            <form method="post"
                                                action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                id="delete-{{ $user->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @if(empty($users))
                                <tr>
                                    <th colspan="9">No hay registros</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const clickDestroy = (event, formId) => {
        let target = event.target;

        let response = confirm("Are you sure you want to delete the user?");
        if (response == true) {
          let form = document.getElementById(formId);

          form.submit();
        }
    }
</script>
