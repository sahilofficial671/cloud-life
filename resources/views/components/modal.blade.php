@props([
    'type'   => 'info',
    'toggle' => 'false',
    'cancel' => 'Cancel',
])

@php
    $class = [
        'info' => [
            'icon' => "M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z",
            'icon_class' => 'text-blue-600',
            'icon_container_class' => 'bg-blue-100'
        ],
        'danger' => [
            'icon' => "M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z",
            'icon_class' => 'text-red-600',
            'icon_container_class' => 'bg-red-100'
        ],
        'warning' => [
            'icon' => "M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z",
            'icon_class' => 'text-yellow-600',
            'icon_container_class' => 'bg-yellow-100'
        ],

        'success' => [
            'icon' => "M5 13l4 4L19 7",
            'icon_class' => 'text-green-600',
            'icon_container_class' => 'bg-green-100'
        ],
    ][$type];
@endphp

<div aria-labelledby="modal-title" role="dialog" aria-modal="true" {!! $attributes->merge(['class' => 'fixed z-50 inset-0 overflow-y-auto']) !!}>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block">

        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all mb-10 sm:my-8 w-11/12 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10 {!! $class['icon_container_class'] !!}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {!! $class['icon_class'] !!}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{!! $class['icon'] !!}" />
                    </svg>
                    </div>
                    <div class="w-full mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                        @isset($header)
                            {!! $header !!}
                        @endisset

                        @isset($body)
                            {!! $body !!}
                        @endisset
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <x-button buttonType="light" value="{!! $cancel !!}" x-on:click="{{$toggle}} = ! {{$toggle}}"/>
            </div>
        </div>
    </div>
</div>
