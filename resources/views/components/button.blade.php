@props([
    'buttonType' => 'primary',
    'type'       => 'button',
    'withIcon'   => false,
    'height'     => 'h-10',
    'disabled'   => false,
    'value'      => '',
])

@php
    $class = 'inline-flex py-2 items-center border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition ease-in-out duration-150 shadow-sm';

    $class .= ' '.$height;

    $class .= $withIcon ? ' px-2.5' : ' px-4';

    $class .= [
        'primary'         => ' bg-green-600 text-white ring-green-200 focus:border-green-700 active:bg-green-700',
        'secondary'       => ' bg-indigo-100 border-indigo-200 border-opacity-60 text-indigo-700 ring-indigo-200 focus:border-indigo-300 active:bg-indigo-900',
        'danger'          => ' bg-red-600 text-white ring-red-200 focus:border-red-700 active:bg-red-700',
        'danger-light'    => ' bg-red-200 text-red-600 ring-red-200 focus:border-red-300 active:bg-red-300 border-red-300 border-opacity-60',
        'warning'          => ' bg-yellow-300 text-yellow-700 ring-yellow-200 focus:border-yellow-700 active:bg-yellow-700',
        'warning-light'    => ' bg-yellow-100 text-yellow-600 ring-yellow-200 focus:border-yellow-300 active:bg-yellow-300 border-yellow-200 border-opacity-60',
        'light'           => ' bg-white text-gray-600 ring-gray-200 focus:border-gray-300 active:bg-gray-300 border-gray-300',
        'light-success'   => ' bg-green-200 text-green-600 ring-green-200 focus:border-green-300 active:bg-green-300 border-green-300 border-opacity-60',
    ][$buttonType];

    $class .= $disabled === 'disabled' ? ' cursor-default' : ' cursor-pointer hover:shadow';

    // Add not disabled classes according to button type
    if($disabled !== 'disabled'){
        $class .= ' '.[
            'primary'         => 'hover:bg-green-700',
            'secondary'       => 'hover:bg-indigo-200',
            'danger'          => 'hover:bg-red-700',
            'danger-light'    => 'hover:bg-red-300',
            'warning'          => 'hover:bg-yellow-500',
            'warning-light'    => 'hover:bg-yellow-200',
            'light'           => 'hover:bg-gray-50',
            'light-success'   => 'hover:bg-green-300',
        ][$buttonType];
    }

@endphp

<button type="{!! $type !!}" {{ $attributes->merge(['class' => $class, 'disabled' => $disabled]) }}>
    {{ $slot }}{!! $value !!}
</button>
