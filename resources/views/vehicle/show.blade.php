<x-app-layout>
    <x-slot name="title">
        {{ __('Vehicle: '.$vehicle->model) }}
    </x-slot>

    <div class="py-10" x-data="{ open: false }">
        <div class="max-w-7xl px-3 mx-auto sm:px-6 lg:px-8">
            <x-back href="{{ route('vehicles.index') }}" />
            <div class="sm:max-w-lg mx-auto">
                <x-alert />
            </div>

            <x-card width="sm:max-w-lg" class="mx-auto">
                <x-slot name="body">
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-start">
                            <div class="left flex items-center">

                                <div class="flex items-center justify-items-center bg-indigo-100 bg-opacity-25 p-1 rounded-full w-16 h-16 mr-2 group-hover:bg-white group-hover:border-2 group-hover:border-indigo-200 border-2 border-indigo-100 ring-2 ring-indigo-50 ring-opacity-25 group-hover:ring-opacity-75 group-hover:ring-indigo-100">
                                    @if ($vehicle->category->isTwoWheeler())
                                        <img src="{{ asset('images/bike/bike-image.svg') }}" alt="Bike" class="inline-flex mr-3">
                                    @endif

                                    @if ($vehicle->category->isFourWheeler())
                                        <x-icons.car class="w-6 mx-auto"/>
                                    @endif
                                </div>

                                <div class="details inline-flex flex-col items-start pt-1">
                                    <div class="text-xs text-indigo-600 font-semibold">{{$vehicle->category->name }}</div>
                                    <h4 class="text-xl font-semibold">{{ __($vehicle->model) }}</h4>
                                    <span class="bg-gray-100 px-2 py-1 text-xs rounded font-semibold group-hover:bg-white border-2 border-gray-100 border-opacity-0 group-hover:border-opacity-100 group-hover:border-2 group-hover:border-gray-100">{{ $vehicle->rc }}</span>
                                </div>
                            </div>
                            <div class="right flex flex-col justify-between">
                                <div class="bg-gray-100 px-2 py-1 text-xs rounded group-hover:bg-white border-2 border-gray-100 border-opacity-0 group-hover:border-opacity-100 group-hover:border-2 group-hover:border-gray-100">ID: {{ $vehicle->id }}</div>
                                <div class="text-center">
                                    <form method="POST" action="{{route('vehicles.destroy', $vehicle)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete" />
                                        <x-button buttonType="danger-light" height="h-7" type="submit" class="mt-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                              </svg>
                                        </x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-card>

            <x-card width="sm:max-w-lg" class="mx-auto mt-3" x-data="{activeTab: 1}">
                <x-slot name="tabs">
                    <div class="tabs flex border-b-2 border-indigo-300 items-center justify-between h-12">
                        <div class="left">
                            <div x-on:click="activeTab = 1" class="px-4 py-3 text-md font-semibold cursor-pointer -m-0.5" :class="{'text-indigo-700 border-b-2 border-indigo-700' : activeTab == 1, 'hover:bg-indigo-50' : activeTab != 1}">Services</div>
                        </div>
                        <div class="right pr-4 flex items-center">
                            <a href="{{ route('vehicles.services.create', [ 'vehicle' => $vehicle->id]) }}" class="py-2 pt-3">
                                <x-button type="submit" buttonType="secondary" height="h-7"  class="sm:px-1 sm:py-1 sm:h-7">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </x-button>
                            </a>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="body">
                    <div>

                        <div class="services" x-show="activeTab == 1">

                            @if ($services->isEmpty())
                                <div class="text-sm px-2 py-4 text-gray-700 text-center">No services yet.</div>
                            @endif

                            @php
                                // Sort paginated items.
                                $items = collect($services->items())->sortByDesc(function($service){
                                    return $service->isPending() && ! $service->isCanceled() && ! $service->isCompleted();
                                });
                            @endphp
                            @foreach ($items as $service)
                            <div class="flex justify-between items-start py-2 md:py-4 px-3 md:px-6 my-2 border-b-2 border-gray-100" x-data="{ isDescriptionActive: false }">
                                <div class="w-7/12 sm:w-6/12 flex items-start">
                                    <div class="relative bg-opacity-50 ring-1 ring-opacity-25 border-2 border-opacity-75 w-14 h-11 md:w-14 md:h-14 mr-3 flex justify-items-center items-center rounded-full {{ $service->isPending() ? 'bg-indigo-50 ring-indigo-50 border-indigo-100' : ''}}
                                    {{ ($service->isCompleted() || $service->isServiced()) ? 'bg-green-50 ring-green-50 border-green-100' : ''}} {{ $service->isCanceled() ? 'bg-red-50 ring-red-50 border-red-100' : ''}}">

                                        <svg class="h-6 w-5 sm:w-6 sm:h-6 mx-auto {{ $service->isPending() ? 'text-opacity-100 text-indigo-500' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-opacity-50 text-green-500' : ''}} {{ $service->isCanceled() ? 'text-opacity-50 text-red-500' : ''}}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">

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
                                        <div class="text-md font-semibold break-words {{ $service->isPending() ? 'text-opacity-100 text-indigo-600' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-opacity-50 text-green-600' : ''}} {{ $service->isCanceled() ? 'text-opacity-50 text-red-600' : ''}}">{{$service->name }}</div>
                                        <div class="flex items-center mt-0.5 sm:mt-1">
                                            <div class="inline-flex mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-0.5 {{ $service->isPending() ? 'text-opacity-100 text-indigo-500' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-opacity-50 text-green-500' : ''}} {{ $service->isCanceled() ? 'text-opacity-50 text-red-500' : ''}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-semibold sm:text-sm text-gray-700 {{ $service->isPending() ? 'text-opacity-100' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-opacity-50' : ''}} {{ $service->isCanceled() ? 'text-opacity-50' : ''}}">
                                                {{
                                                    $service->isPending()
                                                        ?  $service->scheduledAt()->toFormattedDateString()
                                                        : $service->servicedAt()->toFormattedDateString()
                                                }}
                                        </div>
                                    </div>
                                </div>
                                <div class="w-5/12 sm:w-6/12 text-right space-x-1.5 space-y-1.5 sm:space-y-2">
                                    @if ($service->isPending())
                                        @if ($service->isMonthly())
                                            <a href="{{ route('vehicles.services.serviced', [ 'vehicle' => $vehicle, 'service' => $service]) }}" x-data="{ tooltip: false }" class="relative inline-block">
                                                <x-button height="h-8 sm:h-9" buttonType="primary-light" padding="px-1 sm:px-2.5" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </x-button>

                                                <div class="">
                                                    <div class="absolute text-center -top-14 left-2 z-50 w-32 md:w-52 px-2 py-1 text-sm leading-tight transform transition duration-500 ease-in-out  -translate-x-1/2 bg-gray-700 text-gray-100 border-gray-500 border-2 rounded shadow-sm"
                                                    x-show="tooltip">
                                                        <span class="font-semibold">Mark Serviced</span> <br /><span class="text-xs text-gray-400 pl-2">This will also create next service.</span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif

                                        <a href="{{ route('vehicles.services.complete', [ 'vehicle' => $vehicle, 'service' => $service]) }}" x-data="{ tooltip: false }" class="relative inline-block">
                                            <x-button height="h-8 sm:h-9" buttonType="secondary" padding="px-1 sm:px-2.5" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                </svg>
                                            </x-button>

                                            <div class="z-50">
                                                <div class="absolute text-center -top-14 left-2 z-50 w-32 md:w-52 px-2 py-1 text-sm leading-tight transform transition duration-500 ease-in-out   -translate-x-1/2 bg-gray-700 text-gray-100 border-gray-500 border-2 rounded shadow-sm"
                                                x-show="tooltip">
                                                <span class="font-semibold">Mark Completed</span>
                                                <br />
                                                <span class="text-xs text-gray-400 pl-2">Service will be completed.</span>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{{ route('vehicles.services.cancel', [ 'vehicle' => $vehicle, 'service' => $service]) }}" x-data="{ tooltip: false }" class="relative inline-block">

                                            <x-button height="h-8 sm:h-9" buttonType="danger-light" padding="px-1 sm:px-2.5" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </x-button>

                                            <div class="z-10">
                                                <div class="absolute text-center -top-14 left-2 z-10 w-32 md:w-52 px-2 py-1 text-sm leading-tight transform transition duration-500 ease-in-out -translate-x-1/2 bg-gray-700 text-gray-100 border-gray-500 border-2 rounded shadow-sm"
                                                x-show="tooltip">
                                                <span class="font-semibold">Mark Canceled</span>  <br /><span class="text-xs text-gray-400 pl-2">Service will be canceled.</span>
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        @if ($service->isCanceled())
                                        <a class="inline-block">
                                            <x-button height="h-8 sm:h-9" type="submit" buttonType="danger-light" padding="px-1 sm:px-2.5" disabled="disabled">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </x-button>
                                        </a>

                                        @endif

                                        @if (($service->isCompleted() || $service->isNotPending()) && ! $service->isCanceled())
                                        <a class="inline-block">
                                            <x-button height="h-8 sm:h-9" buttonType="primary-light" padding="px-1 sm:px-2.5" disabled="disabled" class="sm:h-9 sm:px-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </x-button>
                                        </a>

                                        @endif
                                    @endif
                                    <a href="{{ route('vehicles.services.edit', [ 'vehicle' => $vehicle, 'service' => $service]) }}" x-data="{ tooltip: false }" class="relative inline-block">
                                        <x-button height="h-8 sm:h-9" buttonType="warning-light" padding="px-1 sm:px-2.5" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 s:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                              </svg>
                                        </x-button>

                                        <div class="z-50">
                                            <div class="absolute text-center -top-10 -left-2 z-50 w-12 md:w-12 px-2 py-1 text-sm leading-tight transform transition duration-500 ease-in-out bg-gray-700 text-gray-100 border-gray-500 border-2 rounded shadow-sm"
                                            x-show="tooltip">
                                                <span class="font-semibold">Edit</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div x-on:click="isDescriptionActive = ! isDescriptionActive" class="relative inline-block">
                                        <a x-data="{ tooltip: false }">
                                            <x-button height="h-8 sm:h-9" buttonType="light" padding="px-1 sm:px-2.5" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 s:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </x-button>

                                            <div class="z-50">
                                                <div class="absolute text-center -top-10 -left-3 z-50 w-14 md:w-16 px-2 py-1 text-sm leading-tight transform transition duration-500 ease-in-out bg-gray-700 text-gray-100 border-gray-500 border-2 rounded shadow-sm"
                                                x-show="tooltip">
                                                    <span class="font-semibold">View</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <a x-data="{ tooltip: false }" class="relative inline-block">
                                        <form method="POST" action="{{route('vehicles.services.destroy', [ 'vehicle' => $vehicle, 'service' => $service])}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete" />
                                            <x-button height="h-8 sm:h-9" buttonType="danger-light" padding="px-1 sm:px-2.5" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"  onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 s:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </x-button>
                                        </form>

                                        <div class="z-50">
                                            <div class="absolute text-center -top-10 -left-3 z-50 w-14 md:w-16 px-2 py-1 text-sm leading-tight transform transition duration-500 ease-in-out bg-gray-700 text-gray-100 border-gray-500 border-2 rounded shadow-sm"
                                            x-show="tooltip">
                                                <span class="font-semibold">Delete</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @php
                                    $type = 'info';
                                    $lable = null;
                                    if($service->isPending()){
                                        $type = 'info';
                                        $lable = 'Pending';
                                    }else if($service->isCanceled()){
                                        $type = 'danger';
                                        $lable = 'Canceled';
                                    }else if($service->isNotPending() || $service->isCompleted()){
                                        $type = 'success';
                                    }

                                @endphp
                                <x-modal x-show="isDescriptionActive" toggle="isDescriptionActive" type="{{$type}}">
                                    <x-slot name="header">
                                        <div class="flex justify-between">
                                            <div id="modal-title">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    {!! $service->name !!}

                                                    <x-pill type="{!! $service->statusType() !!}" value="{!! $service->statusText() !!}" />
                                                </h3>
                                            </div>

                                            <div class="font-semibold bg-gray-100 px-2 py-1 text-xs rounded border-2 border-gray-100 border-opacity-0">
                                                ID: {{ $service->id }}
                                            </div>
                                        </div>
                                    </x-slot>
                                    <x-slot name="body">
                                        <div class="mt-2 text-sm text-gray-500 space-y-2">
                                            <p>{!! $service->description !!}</p>

                                            <div class="mr-1">
                                                <div class="inline-flex">
                                                    <p class="mr-2 text-gray-600 font-semibold">Scheduled On:</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-opacity-100 {{ $service->isPending() ? 'text-indigo-500' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-green-500' : ''}} {{ $service->isCanceled() ? 'text-red-500' : ''}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="text-xs font-semibold sm:text-sm">
                                                        {{ $service->scheduledAt()->toFormattedDateString() }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="mr-1">
                                                <div class="inline-flex">
                                                    <p class="mr-2 text-gray-600 font-semibold">
                                                        {{ ! $service->isCanceled() ? 'Serviced On: ' : 'Canceled On: '}}
                                                    </p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-opacity-100 {{ $service->isPending() ? 'text-indigo-500' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-green-500' : ''}} {{ $service->isCanceled() ? 'text-red-500' : ''}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>

                                                        @if (! $service->isCanceled())
                                                        <span class="text-xs font-semibold sm:text-sm">
                                                            {{ $service->isNotPending() ? $service->scheduledAt()->toFormattedDateString() : 'NA'}}
                                                        </span>

                                                        @else
                                                        <span class="text-xs font-semibold sm:text-sm">
                                                            {{ $service->canceledAt()->toFormattedDateString()}}
                                                        </span>
                                                        @endif
                                                </div>
                                            </div>


                                            <div class="mr-1">
                                                <div class="inline-flex">
                                                    <p class="mr-2 text-gray-600 font-semibold">Created At:</p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-opacity-100 {{ $service->isPending() ? 'text-indigo-500' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-green-500' : ''}} {{ $service->isCanceled() ? 'text-red-500' : ''}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    <span class="text-xs font-semibold sm:text-sm">
                                                        {{ $service->createdAt()->toFormattedDateString()}}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="mr-1">
                                                <div class="inline-flex">
                                                    <p class="mr-2 text-gray-600 font-semibold">Updated At:</p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-opacity-100 {{ $service->isPending() ? 'text-indigo-500' : ''}} {{ ($service->isCompleted() || $service->isServiced()) ? 'text-green-500' : ''}} {{ $service->isCanceled() ? 'text-red-500' : ''}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    <span class="text-xs font-semibold sm:text-sm">
                                                        {{ $service->updatedAt()->toFormattedDateString()}}
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </x-slot>
                                </x-modal>
                            </div>
                            @endforeach
                            <div class="md:px-6 my-3 px-3">
                                @if (!$services->hasPages())
                                <p class="text-sm text-gray-700 leading-5">
                                    {!! __('Showing') !!}
                                    <span class="font-medium">{{ $services->firstItem() }}</span>
                                    {!! __('to') !!}
                                    <span class="font-medium">{{ $services->lastItem() }}</span>
                                    {!! __('of') !!}
                                    <span class="font-medium">{{ $services->total() }}</span>
                                    {!! __('results') !!}
                                </p>
                                @else
                                    {{ $services->links() }}
                                @endif
                            </div>
                        </div>

                    </div>
                </x-slot>
            </x-card>
        </div>
    </div>
</x-app-layout>
