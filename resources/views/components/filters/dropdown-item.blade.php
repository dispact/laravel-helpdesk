@props(['active' => false])

@php
    $classes = "text-gray-700 dark:text-gray-200 block px-4 py-2 text-sm
        hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer";
    
    if ($active === true) 
        $classes .= " bg-blue-400 hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600";
@endphp

<a {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</a>
          