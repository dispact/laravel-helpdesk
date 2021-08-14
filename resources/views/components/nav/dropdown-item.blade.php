@props(['icon' => '', 'text' => '', 'link' => '#', 'type' => ''])

@php
    $class = "inline-flex items-center w-full px-2 py-1 text-sm 
        font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 
        hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200";
@endphp

<li class="flex">
    @if ($type == 'button')
        <form method="POST" action="{{ $link }}" class="w-full">
            @csrf
            <button type="submit" class="{{ $class }}">
    @else
        <a class="{{ $class }}" href="{{ $link }}">
    @endif
            <x-icons.icon name='{{ $icon }}'/>
            <span>{{ $text }}</span>
    @if ($type == 'button')
            </button>
        </form>
    @else
        </a>
    @endif
</li>