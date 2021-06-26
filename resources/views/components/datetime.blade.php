@props([
    'disabled'    => false,
    'type'        => 'text',
    'name'        => 'datetime',
    'isHidden'    => false,
    'placeholder' => 'Select date',
    'value'       => '',
])

@php
    $classes = 'w-full shadow-sm border-gray-300 focus:ring focus:ring-opacity-50 rounded-md focus:border-green-300 focus:ring-green-200 text-sm text-gray-700 cursor-pointer';

    if($isHidden){
        $classes .= " hidden";
    }
@endphp

<div class="relative">
    <input type="hidden" name="{{ $name }}" x-ref="date" value="{!! $value !!}" class="datetime">
    <input
        {!! $attributes->merge([
            'type'            => $type,
            'class'           => $classes,
            'x-model'         => "datepickerValue",
            '@click'          => "showDatepicker = !showDatepicker",
            '@keydown.escape' => "showDatepicker = false",
            'placeholder'     => $placeholder,
            'x-ref'           => 'datetime',
        ]) !!}
        readonly>

    <!-- icon -->
    <div class="absolute top-0 right-0 px-3 py-2 -mt-0.5 {!! $isHidden ? 'hidden' : ''!!}">
        <svg class="h-6 w-5 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>

    <!-- Calendar -->
    <div
        class="z-10 bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0 w-64 md:w-80 {!! $isHidden ? 'hidden' : ''!!}"
        x-show.transition="showDatepicker"
        @click.away="showDatepicker = false">

        <div class="flex justify-between items-center mb-2">
            <div>
                <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
            </div>
            <div>
                <button
                    type="button"
                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                    :class="{'cursor-not-allowed opacity-25': month == 0 }"
                    :disabled="month == 0 ? true : false"
                    @click="month--; getNoOfDays()">
                    <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button
                    type="button"
                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                    :class="{'cursor-not-allowed opacity-25': month == 11 }"
                    :disabled="month == 11 ? true : false"
                    @click="month++; getNoOfDays()">
                    <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-wrap mb-3 -mx-1">
            <template x-for="(day, index) in DAYS" :key="index">
                <div style="width: 14.26%" class="px-1">
                    <div
                        x-text="day"
                        class="text-gray-800 font-medium text-center text-xs"></div>
                </div>
            </template>
        </div>

        <div class="flex flex-wrap -mx-1">
            <template x-for="blankday in blankdays">
                <div
                    style="width: 14.28%"
                    class="text-center border p-1 border-transparent text-sm"
                ></div>
            </template>
            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                <div style="width: 14.28%" class="px-1 mb-1">
                    <div
                        @click="getDateValue(date)" x-text="date"
                        class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                        :class="{
                            'bg-blue-200': isToday(date) == true,
                            'text-gray-600 hover:bg-blue-200': isToday(date) == false && isCurrentlySelected(date) == false,
                            'bg-blue-500 text-white hover:bg-opacity-75': isCurrentlySelected(date) == true
                        }"
                    ></div>
                </div>
            </template>
        </div>
    </div>
</div>
