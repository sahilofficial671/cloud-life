<div {{$attributes->merge(['class' => 'flex flex-col items-center mx-2 '])}}>
    <div {{$attributes->merge(['class' => "w-full sm:max-w-md mt-2 sm:mt-4 md:mt-6 bg-white shadow-md overflow-hidden rounded-lg"])}}>

        @isset ($header)
            <div class="text-sm sm:text-base text-grey-900 px-6 py-3 sm:py-4 bg-white border-b-2 border-gray-200">
                {{ $header}}
            </div>
        @endisset

        @isset($body)
            {{ $body }}
        @endisset

        {{ $slot }}
    </div>
</div>
