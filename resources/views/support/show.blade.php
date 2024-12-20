{{-- resources/views/support/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Support Ticket Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        Ticket ID: {{ $ticket->id }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        <strong>User:</strong> {{ $ticket->user->name }}
                    </p>
                    @if ($ticket->assignedTo)
                        <p class="mt-2 text-sm text-gray-600">
                            <strong>Assigned To:</strong> {{ $ticket->assignedTo->name }}
                        </p>
                    @endif
                    <p class="mt-2 text-sm text-gray-600">
                        <strong>Status:</strong> {{ $ticket->status }}
                    </p>
                    <p class="mt-2 text-sm text-gray-600">
                        <strong>Description:</strong><br>
                        {{ $ticket->description }}
                    </p>
                </div>
                <div class="mt-4">
                    @if ($ticket->status === 'pending')
                        <form action="{{ route('support.assign', $ticket->id) }}" method="POST">
                            @csrf
                            <x-primary-button>
                                {{ __('Take Case') }}
                            </x-primary-button>
                        </form>

                    @elseif ($ticket->status === 'assigned')
                        <form action="{{ route('support.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="closed">
                            <x-primary-button>
                                {{ __('Close Case') }}
                            </x-primary-button>
                        </form>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <form action="{{ route('support.destroy', $ticket->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>
                                {{ __('Delete') }}
                            </x-danger-button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

