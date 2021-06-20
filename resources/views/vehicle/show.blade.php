<x-app-layout>
    <x-slot name="title">
        {{ __('Vehicle: '.$vehicle->model) }}
    </x-slot>

    <div class="py-10" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2">
            <div class="sm:max-w-lg mx-auto">
                @alertSuccess
                @alertError
            </div>
            <x-card width="sm:max-w-lg" class="mx-auto">
                <x-slot name="body">
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <div><img src="{{ asset('images/bike/bike-image.svg') }}" alt="Bike" class="inline-flex mr-3"></div>
                                <div class="details inline-flex flex-col items-start pt-1">
                                    <div class="text-sm text-indigo-600 font-semibold">{{$vehicle->category->name }}</div>
                                    <h4 class="text-lg font-semibold">{{ __($vehicle->model) }}</h4>
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

            <x-card width="sm:max-w-lg" class="mx-auto mt-3" x-data="{activeTab: 1}">
                <x-slot name="tabs">
                    <div class="tabs flex border-b-2 border-indigo-300">
                        <div x-on:click="activeTab = 1" class="px-4 py-3 text-md font-semibold cursor-pointer hover:bg-indigo-50 -m-0.5" :class="{'text-indigo-700 border-b-2 border-indigo-700' : activeTab == 1}">Services</div>
                    </div>
                </x-slot>
                <x-slot name="body">
                    <div>

                        <div class="services" x-show="activeTab == 1">
                            @foreach ($services as $service)
                            @php
                                $color = $service->isPending() ? 'indigo' : 'green';
                                $textOpacity = $service->isPending() ? '100' : '50';
                            @endphp
                            <div class="flex justify-between items-start md:my-8 md:px-8 my-3 px-3">
                                <div class="flex items-start">
                                    <div class="relative bg-{{$color}}-50 bg-opacity-50 ring-1 ring-opacity-25 border-2 border-{{$color}}-100 border-opacity-75 ring-{{$color}}-50 w-11 h-11 md:w-14 md:h-14 mx-auto mr-3 flex justify-items-center items-center rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-opacity-{{$textOpacity}} sm:w-6 sm:h-6 mx-auto text-{{$color}}-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        @if ($service->isPending())
                                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute -top-1 -right-1 h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>

                                    <div class="details inline-flex flex-col items-start pt-0.5 sm:pt-2">
                                        <div class="text-md text-{{$color}}-600 text-opacity-{{$textOpacity}} font-semibold">{{$service->name }}</div>
                                        <div class="flex items-center mt-0.5 sm:mt-1">
                                            <div class="icon inline-flex mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-0.5 text-{{$color}}-500 text-opacity-{{$textOpacity}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-semibold sm:text-sm text-gray-700 text-opacity-{{$textOpacity}}">
                                                @if ($service->isPending())
                                                    {{ $service->scheduledAt()->toFormattedDateString()}}</span>
                                                @else
                                                    {{ $service->servicedAt()->toFormattedDateString()}}</span>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    @if ($service->isPending())
                                        <a href="{{ route('vehicles.services.destroy', [ 'vehicle_id' => $vehicle->id, 'service_id' => $service->id]) }}">
                                            <x-button type="submit" buttonType="light-success" withIcon="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </x-button>
                                        </a>
                                    @else
                                    <x-button buttonType="light-success" withIcon="true" disabled="disabled" class="hover:bg-green-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </x-button>
                                    @endif
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </x-slot>
            </x-card>
        </div>
    </div>
</x-app-layout>
