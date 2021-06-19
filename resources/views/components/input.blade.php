@props([
    'disabled' => false,
    'type' => 'text',
])

@php

    $classes = 'shadow-sm border-gray-300 focus:ring focus:ring-opacity-50';

    $classes .= [
        'text'     => ' rounded-md focus:border-green-300 focus:ring-green-200',
        'number'   => ' rounded-md focus:border-green-300 focus:ring-green-200',
        'email'    => ' rounded-md focus:border-green-300 focus:ring-green-200',
        'checkbox' => ' rounded h-5 w-5 checked:text-blue-600 text-blue-600 focus:outline-none focus:ring-blue-200',
    ][$type];

@endphp
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['type' => $type, 'class' => $classes]) !!}>
