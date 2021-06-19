@php
    $class = 'border-2 shadow-sm rounded px-2 py-2 my-2 flex justify-between items-center pl-6 text-sm';

    $class .= [
        'success' => ' bg-green-100 text-green-900 border-green-200',
        'error' => ' bg-red-100 text-red-900 border-red-200',
        'info' => ' bg-blue-100 text-blue-900 border-blue-200',
        'warning' => ' bg-yellow-100 text-yellow-900 border-yellow-200',
    ][$type];

@endphp
@if (session($type))
<div x-data="{ isHidden: false }">
    <div {{ $attributes->merge(['class' => $class])}}  :class="{'hidden': isHidden }">
    <div class="message">{{session($type)}}</div>
    <button x-on:click="isHidden = ! isHidden" type="button" class="inline-flex items-center justify-center p-2 lg:p-0 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': isHidden }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    </div>
</div>
@endif
