
<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicles') }}
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <form method="POST" action="{{route('vehicles.destroy.bulk')}}" x-data="component()">
                    @csrf
                    <div class="pb-3 text-right">
                        <a href="{{route('vehicles.create')}}">
                            <x-button type="button" withIcon="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>

                                {{ __('Add New') }}
                            </x-button>
                        </a>
                        <x-button buttonType="danger" type="submit" withIcon="true" x-bind:disabled="items.length == 0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                        </x-button>
                    </div>
                    <x-alert type="success" />
                    <x-alert type="error" />
                    <div class="bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg overflow-x-auto">
                        <table class="table w-full whitespace-nowrap overflow-y-auto">
                            <thead>
                                <tr class="focus:outline-none h-14 w-full text-sm leading-none text-gray-800">
                                    <th scope="col"></th>
                                    <th scope="col">ID</th>
                                    <th scope="col" class="text-left">Model</th>
                                    <th scope="col" class="text-left">Detail</th>
                                    <th scope="col" class="text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $vehicle)
                                <tr class="group focus:outline-none h-16 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100">
                                    <td class="w-20 text-center">
                                        <x-input type="checkbox" name="vehicles[]" value="{{$vehicle->id}}"
                                            x-bind:checked="itemSelected({{$vehicle->id}})" x-on:change="toggleItem({{$vehicle->id}})"/>
                                    </td>
                                    <td class="w-20 text-center"><span class="bg-gray-100 px-2 py-1 text-xs rounded group-hover:bg-white">ID: {{ $vehicle->id }}</span></td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->detail }}</td>
                                    <td>
                                        <a href="{{ route('vehicles.show', $vehicle->id) }}">
                                            <x-button buttonType="light" type="button">View</x-button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="px-5 py-2">
                            @if (!$vehicles->hasPages())
                                <p class="text-sm text-gray-700 leading-5">
                                    {!! __('Showing') !!}
                                    <span class="font-medium">{{ $vehicles->firstItem() }}</span>
                                    {!! __('to') !!}
                                    <span class="font-medium">{{ $vehicles->lastItem() }}</span>
                                    {!! __('of') !!}
                                    <span class="font-medium">{{ $vehicles->total() }}</span>
                                    {!! __('results') !!}
                                </p>
                            @endif
                            {{ $vehicles->links() }}
                        </div>
                    </div>
                </form>
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


