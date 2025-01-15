<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genealogical Tree') }}
        </h2>
    </x-slot>

    <style>
        .tree ul {
            padding-left: 20px;
            position: relative;
        }

        .tree ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 100%;
        }

        .tree li {
            list-style-type: none;
            margin: 10px 0;
            padding-left: 20px;
            position: relative;
        }

        .tree li::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-top: 1px solid #ccc;
            width: 20px;
            height: 0;
        }

        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-left: 1px solid #ccc;
            width: 0;
            height: 100%;
        }

        .tree li:last-child::after {
            display: none;
        }

        .tree span {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <button onclick="navigator.clipboard.writeText('{{ $user->referralLink() }}')"
                    class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                    Copy Referral Link
                </button>

                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Árbol Genealógico -->
                    <div class="tree">
                        <ul>
                            <li>
                                <span>{{ $user->name }} {{ $user->lastname }} ({{ $user->role }})</span>
                                <ul>
                                    @foreach ($user->children as $child)
                                        <li>
                                            <span>{{ $child->name }} {{ $child->lastname }}
                                                ({{ $child->role }})</span>
                                            <ul>
                                                @foreach ($child->children as $grandchild)
                                                    <li><span>{{ $grandchild->name }} {{ $grandchild->lastname }}
                                                            ({{ $grandchild->role }})</span></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
