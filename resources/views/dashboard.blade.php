<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message/>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 max-w-2xl mx-auto">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('This is your data:') }}
                    </h2>

                    @include('users.fields', ['user' => auth()->user(), 'disabled' => 'disabled'])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
