<x-app-layout>
    <x-slot name="title">
        {{ __('Create New Vehicle') }}
    </x-slot>

    <div class="py-10" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @alertSuccess
            @alertError
            <x-card>
                <x-slot name="header">
                    Create New Vehicle
                </x-slot>
                <x-slot name="body">
                    <form method="POST" action="{{ route('vehicles.store') }}" class="px-6 py-4">
                        @csrf

                        <div class="my-3">
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div class="my-3">
                            <x-label for="description" :value="__('Description')" />
                            <x-textarea id="description" class="block mt-1 w-full" type="textarea" name="description" :value="old('description')" required />
                        </div>

                        <x-button type="submit">
                            {{ __('Create') }}
                        </x-button>
                    </form>
                </x-slot>
            </x-card>
        </div>
    </div>
</x-app-layout>
