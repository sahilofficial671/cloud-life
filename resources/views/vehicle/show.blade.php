<x-app-layout>
    <x-slot name="title">
        {{ __('Vehicle: '.$vehicle->name) }}
    </x-slot>

    <div class="py-10" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @alertSuccess
            @alertError
            <x-card width="sm:max-w-md">
                <x-slot name="body">
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <div><img src="{{ asset('images/bike/bike-image.svg') }}" alt="Bike" class="inline-flex mr-3"></div>
                                <div class="details inline-flex flex-col items-start pt-1">
                                    <div class="text-sm text-indigo-600 font-semibold">Bike</div>
                                    <h4 class="text-lg font-semibold">{{ __($vehicle->name) }}</h4>
                                    <span class="bg-gray-100 px-2 py-1 text-xs rounded font-semibold">{{ $vehicle->rc }}</span>
                                </div>
                            </div>
                            <div>
                                <span class="bg-gray-100 px-2 py-1 text-xs rounded">ID: {{ $vehicle->id }}</span>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-card>
        </div>
    </div>
</x-app-layout>
