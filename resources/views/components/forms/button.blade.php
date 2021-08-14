@props(['label' => 'Blank', 'color' => 'blue'])
<button type="submit" class="px-5 py-3 font-medium leading-5 text-white transition-colors 
    duration-150 bg-{{ $color }}-600 border border-transparent rounded-lg active:bg-{{ $color }}-600 
    hover:bg-{{ $color }}-700 focus:outline-none focus:shadow-outline-{{ $color }}
    dark:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700"
>
    {{ $label }}
</button>