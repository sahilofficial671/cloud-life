@php
    $class = 'border-2 shadow-sm rounded px-2 py-2 my-2 flex justify-between items-center pl-3 text-sm bg-opacity-80';
    $iconClass = 'flex items-center border-2 justify-center h-10 w-10 flex-shrink-0 rounded-full mr-2';

    $types = [
        'success' => [
            'class'      => $class.' bg-green-200 text-green-900 border-green-200',
            'icon_class' => $iconClass.' bg-green-100 border-green-500 text-green-600',
            'icon'       => "M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z",
        ],
        'error' => [
            'class'      => $class.' bg-red-200 text-red-900 border-red-200',
            'icon_class' => $iconClass.' bg-red-100 border-red-500 text-red-600',
            'icon'       => "M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z",
        ],

        'info' => [
            'class'      => $class.' bg-blue-200 text-blue-900 border-blue-200',
            'icon_class' => $iconClass.' bg-blue-100 border-blue-500 text-blue-600',
            'icon'       => "M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z",
        ],

        'warning' => [
            'class'      => $class.' bg-yellow-200 text-yellow-900 border-yellow-200',
            'icon_class' => $iconClass.' bg-yellow-100 border-yellow-500 text-yellow-600',
            'icon'       => "M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z",
        ],
    ];

@endphp

@foreach (['success', 'error', 'info', 'warning'] as $type)
    @if (session()->has($type))
    <div x-data="{ isHidden: false }" class="w-full">
        <div {{ $attributes->merge(['class' => $types[$type]['class']])}}  :class="{'hidden': isHidden }">
            <div class="flex items-center">
                <div class="{!! $types[$type]['icon_class'] !!}">
                    <span>
                        <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                            <path fill-rule="evenodd" d="{!! $types[$type]['icon'] !!}" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                <div class="text-md font-semibold">{{ session($type) }}</div>
            </div>

            <button x-on:click="isHidden = ! isHidden" type="button" class="inline-flex items-center justify-center p-2 lg:p-0 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': isHidden }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    @endif
@endforeach

