<div>
    <input
        type="file"
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($accept) accept="{{ $accept }}" @endif
        {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}
    />
</div>
