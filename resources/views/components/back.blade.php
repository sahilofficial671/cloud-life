@props(['value' => 'Back'])

<a {{ $attributes->merge(['class' => "ml-2 items-center hover:bg-gray-50 bg-opacity-50 rounded inline-flex"])}}>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 -mt-0.5 hover:text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>

    <span class="text-sm text-gray-600 hover:text-gray-900">{{ __($value)}}</span>
</a>
