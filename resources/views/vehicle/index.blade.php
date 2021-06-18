<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicles') }}
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-3 text-right">
                <a href="{{route('vehicles.create')}}"><x-button buttonType="secondary">{{ __('Add New') }}</x-button></a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <table class="table w-full whitespace-nowrap overflow-y-auto">
                        <thead>
                            <tr class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800">
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col" class="text-left">Name</th>
                                <th scope="col" class="text-left">Description</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach($vehicles as $vehicle)
                            <tr class="group focus:outline-none h-16 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100">
                                <td class="w-12 text-center">{{ $loop->index + 1 }}</td>
                                <td class="w-20 text-center"><span class="bg-gray-100 px-2 py-1 text-xs rounded group-hover:bg-white">ID: {{ $vehicle->id }}</span></td>
                                <td>{{ $vehicle->name }}</td>
                                <td>{{ $vehicle->description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-5 py-2">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
