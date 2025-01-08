<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Support Tickets') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('support.store') }}">
                        @csrf
                        <div class="mt-4">
                            <label for="subject">Subject:</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="mt-4">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>
                        <div class="mt-4">
                            <label for="category"></label>
                            <select id="category" class="block mt-1 w-full" name="category" required>
                                <option value="" disabled selected>{{ __('Select a category') }}</option>
                                <option value="general">{{ __('General') }}</option>
                                <option value="technical">{{ __('Technical') }}</option>
                                <option value="billing">{{ __('Billing') }}</option>
                                <option value="line_issues">{{ __('Line Issues') }}</option>
                                <option value="back_office_failures">{{ __('Back Office Failures') }}</option>
                                <option value="commission_inconsistencies">{{ __('Commission Inconsistencies') }}</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Ticket') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
