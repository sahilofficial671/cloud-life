
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
                        <a href="{{route('vehicles.create')}}"><x-button type="button" buttonType="secondary">{{ __('Add New') }}</x-button></a>
                        <x-button buttonType="danger" type="submit" x-bind:disabled="items.length == 0">{{ __('Delete') }}</x-button>
                    </div>
                    <x-alert type="success" />
                    <x-alert type="error" />
                    <div class="bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="table w-full whitespace-nowrap overflow-y-auto">
                            <thead>
                                <tr class="focus:outline-none h-14 w-full text-sm leading-none text-gray-800">
                                    <th scope="col"></th>
                                    <th scope="col">ID</th>
                                    <th scope="col" class="text-left">Name</th>
                                    <th scope="col" class="text-left">Description</th>
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
                                    <td>{{ $vehicle->name }}</td>
                                    <td>{{ $vehicle->description }}</td>
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


