@props(['buttonType' => null])

@php
    $class = 'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-500 disabled:opacity-25 transition ease-in-out duration-150';

    if($buttonType == "secondary"){
        $class .= " bg-indigo-100 hover:bg-indigo-200 text-indigo-700 ring-indigo-200 focus:border-indigo-300";
    }
@endphp


<button {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</button>
