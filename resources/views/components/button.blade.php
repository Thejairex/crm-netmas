<div>
    <button {{ $attributes->merge(['class' => 'bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700']) }}>
        {{ $slot }}
    </button>
</div>
