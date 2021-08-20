@props(['title' => '', 'label' => ''])

<div class="relative inline-block text-left ml-2 mb-2 "
    x-data="{ open: false }" @click.away="open = false" @close.stop="open = false"
>
    <p class="text-gray-700 text-center text-xs mb-1
        dark:text-gray-200">{{ $label }}</p>
    <div @click=" open = !open">
        <button class="inline-flex justify-center w-full rounded-md shadow-md px-4 py-2 
            bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 
            hover:bg-gray-50 dark:hover:bg-gray-600 text-sm font-medium 
            focus:outline-none focus:ring-2 focus:ring-blue-500" 
        >
            {{ $title }}
            <x-icons.icon name="dropdown"/>
        </button>
    </div>

    <div x-show="open" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" 
        tabindex="-1" class="origin-top-left z-50 absolute left-0 mt-2 w-56 rounded-md shadow-lg 
            bg-white dark:bg-gray-700 ring-2 ring-gray-700 dark:ring-gray-200 
            ring-opacity-25 dark:ring-opacity-25 focus:outline-none"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
    >
        <div class="py-1">
            {{ $slot }}
        </div>
    </div>
</div>