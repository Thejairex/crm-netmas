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
                    {{ __("You're logged in!") }}
                </div>
                <div class="flex flex-col md:flex-row md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <p class="text-lg font-semibold">{{ __('Welcome,') }} {{ auth()->user()->username }}!</p>
                        @can('supplier', auth()->user())

                            @if (auth()->user()->rank)
                                <p class="text-sm">
                                    {{ __('Your current rank is :rank.', ['rank' => auth()->user()->rank->name]) }}</p>
                            @endif

                            @if ($nextRank = auth()->user()->nextRank)
                                <p class="text-sm">
                                    {{ __('Your next rank is :rank and you need :points points to reach it.', ['rank' => $nextRank->name, 'points' => $nextRank->points - auth()->user()->points]) }}
                                </p>
                            @endif
                        </div>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold">{{ __('You have') }} {{ auth()->user()->balance_points }}
                                {{ __('points.') }}</p>
                        </div>
                    @endcan
                </div>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
