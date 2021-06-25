<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl px-3 mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto">
                <div class="flex flex-wrap w-full mb-7 sm:mb-10 md:mb-12 lg:mb-15 flex-col items-center text-center">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Cloud Life Dashboard</h1>
                    <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Manage your life in cloud!</p>
                </div>
                <div class="md:flex md:flex-wrap -m-4">

                    <div class="md:w-1/2 lg:w-1/3 p-4">
                        <a href="{{ route('vehicles.index') }}">
                            <x-card width="max-w-xs md:max-w-sm" class="ring-1 ring-indigo-50 hover:ring-4 hover:ring-indigo-100 ring-opacity-75">
                                <x-slot name="body">
                                    <div class="group">
                                        <div class="flex justify-between items-center">
                                            <div class="left w-3/4 px-4 sm:px-6 py-4">
                                                <h2 class="text-lg text-gray-900 font-semibold title-font mb-1">Vehicles</h2>
                                                <p class="leading-tight text-gray-500 text-sm sm:text-base">Sleek vehicles management out-of-the-box.</p>
                                            </div>
                                            <div class="right w-1/4 text-center px-4 sm:px-6">
                                                <div class="text-8xl md:text-9xl font-semibold md:font-bold text-indigo-100 bg-opacity-70 -ml-4 transition-all duration-300 ease-in-out">
                                                    {{ $vehicles }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot>
                            </x-card>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
