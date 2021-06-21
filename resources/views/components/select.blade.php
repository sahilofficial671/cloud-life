@php
    $classes = 'w-full shadow-sm border-gray-300 focus:ring focus:ring-opacity-50 rounded-md focus:border-green-300 focus:ring-green-200 cursor-pointer';
@endphp

<select {!! $attributes->merge(['class' => $classes]) !!}>
    {{ $slot }}
</select>
