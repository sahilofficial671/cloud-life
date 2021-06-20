<x-app-layout>
    <x-slot name="title">
        {{ __('Create New Vehicle') }}
    </x-slot>

    <div class="py-10" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-back href="{{ route('vehicles.index') }}" />
            @alertSuccess
            @alertError
            <div class="flex flex-col items-center mx-2">
                <x-card>
                    <x-slot name="header">
                        Create New Vehicle
                    </x-slot>
                    <x-slot name="body">
                        <form method="POST" action="{{ route('vehicles.store') }}" class="px-6 py-4">
                            @csrf

                            <div class="my-3">
                                <x-label for="name" :value="__('Name')" class="mb-1"/>
                                <x-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" required autofocus />
                            </div>

                            <div class="my-3">
                                <x-label for="detail" :value="__('Detail')" class="mb-1" />
                                <x-textarea id="detail" class="block mt-1 w-full" type="textarea" name="detail" :value="old('detail')" required />
                            </div>

                            <div class="my-3">
                                <x-label for="category_id" :value="__('Category')" class="mb-1" />
                                <x-select name="category_id" id="category_id" required>
                                    <option>{{ __('Select Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div class="my-3">
                                <x-label for="manufacturer" :value="__('Manufacturer')" class="mb-1"/>
                                <x-input id="manufacturer" class="block mt-1 w-full" type="text" name="manufacturer" :value="old('manufacturer')" required autofocus />
                            </div>

                            <div class="my-3">
                                <x-label for="rc" :value="__('RC')" class="mb-1"/>
                                <x-input id="rc" class="block mt-1 w-full" type="text" name="rc" :value="old('rc')" required autofocus />
                            </div>

                            <div class="my-3">
                                <x-label for="monthly_service_in_days" :value="__('Monthly Service In Days')" class="mb-1"/>
                                <x-input id="monthly_service_in_days" class="block mt-1 w-full" type="text" name="monthly_service_in_days" :value="old('monthly_service_in_days')" required autofocus />
                            </div>

                            <x-button type="submit">
                                {{ __('Create') }}
                            </x-button>
                        </form>
                    </x-slot>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
