<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message/>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="5" scope="col items-end" style="text-align: end;">
                                    <!-- queue pending mails button -->
                                    <form method="post" action="{{ route('emailMessages.queueEmailMessages') }}" id="queue-email-messages">
                                        @csrf @method('put')
                                    </form>
                                    <x-button class="ml-3 bg-blue-500" type='button' onclick="clickQueue(event)">
                                        {{ __('Queue email messages') }}
                                    </x-button>

                                    <!-- create button -->
                                    <a href="{{ route('emailMessages.create') }}">
                                        <x-button class="ml-3 bg-green-500">
                                            {{ __('New email') }}
                                        </x-button>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emailMessages as $index => $emailMessage)
                                <tr>
                                    <td scope="row">
                                        {{ $emailMessage->to }}
                                    </td>
                                    <td>
                                        <strong>{{ Str::limit($emailMessage->subject, 30, ' (...)') }}</strong>

                                        {{ Str::limit($emailMessage->body, 50, ' (...)') }}
                                    </td>
                                    <td>
                                        <span
                                            title="{{ $emailMessage->wasSent() ? $emailMessage->sent_at : '' }}"
                                            class="inline-block rounded-full
                                            text-white px-2 py-1
                                            text-xs font-bold mr-3
                                            {{ $emailMessage->wasSent()
                                                ? 'bg-green-500'
                                                : (
                                                    $emailMessage->wasQueued()
                                                        ? 'bg-yellow-500'
                                                        : 'bg-red-500'
                                                )
                                            }}"
                                        >{{ $emailMessage->status }}</span>
                                    </td>
                                    <td>
                                        {{ $emailMessage->created_at->format('d/m/Y') }}
                                    </td>
                                    <td style="text-align: end;">
                                        <!-- show button -->
                                        <a href="{{ route('emailMessages.show', $emailMessage) }}">
                                            <x-button class="ml-3" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12
                                                        5c4.478 0 8.268 2.943 9.542 7-1.274
                                                        4.057-5.064 7-9.542 7-4.477
                                                        0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </x-button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @if(empty($emailMessages))
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
    const clickQueue = (event) => {
        let response = confirm("Are you sure you want to queue all the pending email messages?");
        if (response == true) {
          let form = document.getElementById('queue-email-messages');

          form.submit();
        }
    }
</script>
