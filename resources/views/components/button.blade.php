@props(['buttonType' => 'primary'])

@php
    $class = 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition ease-in-out duration-150 shadow-sm hover:shadow';

    $class .= [
        'primary'   => ' bg-green-600 hover:bg-green-700 text-white ring-green-200 focus:border-green-700 active:bg-green-700',
        'secondary' => ' bg-indigo-100 hover:bg-indigo-200 text-indigo-700 ring-indigo-200 focus:border-indigo-300 active:bg-indigo-900',
        'danger'    => ' bg-red-600 hover:bg-red-700 text-white ring-red-200 focus:border-red-700 active:bg-red-700',
    ][$buttonType];

@endphp


<button {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</button>
