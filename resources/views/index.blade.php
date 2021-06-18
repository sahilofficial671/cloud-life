<x-guest-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <div class="lg:max-w-2xl lg:w-full sm:text-center lg:text-left">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block inline">Manage your life in</span>
                <span class="block text-green-600 inline">Cloud</span>
            </h1>
            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                Cloud life is light weight personal CRM.
            </p>
            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                <div class="rounded-md shadow">
                <a href="{{route('login')}}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                    Get started
                </a>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-3">
                <a href="https://cloud-life.webiggle.com/" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                    Live demo
                </a>
                </div>
            </div>
        </div>

        <img alt="Cloud" class="lg:w-1/2 w-full lg:h-auto h-64 lg:pl-20 mt-4 my-3" src="{{ url('/images/bg-image-1.png')}}">
        </div>
</x-guest-layout>
