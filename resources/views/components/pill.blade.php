@props([
    'type'  => 'info',
    'value' => 'Information',
])

@php
    $class = 'text-xs text-center font-semibold p-1 rounded-md';

    $class .= ' '.[
        'info'    => 'bg-indigo-100 text-indigo-600',
        'danger'  => 'bg-red-100 text-red-600',
        'light'   => 'bg-gray-100 text-gray-600',
        'warning' => 'bg-yellow-100 text-yellow-600',
        'success' => 'bg-green-100 text-green-600',
    ][$type];
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>
    {!! $value !!}
</span>
