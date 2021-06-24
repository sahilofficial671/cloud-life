
<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicles') }}
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl px-3 mx-auto sm:px-6 lg:px-8">

            <div class="pb-2">
                <div class="sm:flex sm:flex-wrap items-center">
                    <div class="left sm:w-1/2 text-left">
                        @if ($vehicles->isEmpty())
                        No vehicles yet.
                        @endif
                    </div>
                    <div class="right sm:w-1/2 sm:text-right ml-3 sm:ml-0">
                        <a href="{{route('vehicles.create')}}">
                            <x-button type="button" withIcon="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>

                                {{ __('Add New') }}
                            </x-button>
                        </a>
                    </div>
                </div>
            </div>

            <x-alert />

            <div class="sm:flex sm:flex-wrap">
                @foreach ($vehicles as $vehicle)
                <div class="pt-2 md:w-1/3 text-center">
                    <a href="{{ route('vehicles.show', $vehicle) }}">
                        <x-card width="max-w-xs md:max-w-sm" class="ring-1 ring-indigo-50 hover:ring-2 hover:ring-indigo-50 ring-opacity-75 group transition-all duration-300 ease-in-out transform hover:-translate-y-2">
                            <x-slot name="body">
                                <div class="px-6 py-4">
                                    <div class="flex justify-between items-start">
                                        <div class="left flex items-center">

                                            <div class="flex items-center justify-items-center bg-indigo-100 bg-opacity-25 p-1 rounded-full w-16 h-16 mr-2 border-2 border-indigo-100 border-opacity-50">
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
                                                <span class="bg-gray-100 px-2 py-1 text-xs rounded font-semibold">{{ $vehicle->rc }}</span>
                                            </div>
                                        </div>
                                        <div class="right flex flex-col justify-between">
                                            <div class="bg-gray-100 px-2 py-1 text-xs rounded">ID: {{ $vehicle->id }}</div>

                                            <div class="text-center">
                                                <form method="POST" action="{{route('vehicles.destroy', $vehicle)}}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="delete" />
                                                    <x-button buttonType="danger-light" height="h-7" type="submit" withIcon="true" x-bind:disabled="items.length == 0"  class="mt-5">
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
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <script>
        function component() {
             return {
                 items: [],

                 itemSelected(item) {
                     return this.items.indexOf(item) > -1;
                 },

                 toggleItem(item) {
                     if (this.itemSelected(item)) {
                        this.items = this.items.filter(i => i !== item);
                     }
                     else {
                        this.items.push(item);
                     }
                 },
             }
         };
     </script>
</x-app-layout>


