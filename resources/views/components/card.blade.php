@props(['width' => 'sm:max-w-md'])

@php
    $class = 'w-full mt-2 sm:mt-4 md:mt-6 bg-white shadow-md overflow-hidden rounded-lg '.$width;
@endphp
<div {{$attributes->merge(['class' => $class])}}>

    @isset ($header)
        <div class="text-sm sm:text-base text-grey-900 px-6 py-3 sm:py-4 bg-white border-b-2 border-gray-200">
            {{ $header}}
        </div>
    @endisset

    @isset($tabs)
        {{ $tabs }}
    @endisset

    @isset($body)
        {{ $body }}
    @endisset

    {{ $slot }}
</div>
