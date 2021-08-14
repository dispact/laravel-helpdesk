@props(['link' => '#', 'title' => 'default', 'active' => 'false', 'icon' => ''])
<li class="relative px-6 py-3">
    @if ($active == true)
        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg" 
            aria-hidden="true"
        ></span>
    @endif
    <a
        class="inline-flex items-center w-full text-sm font-semibold 
            transition-colors duration-150 
            @if($active == true) 
            dark:text-gray-100 text-gray-800 hover:text-gray-600 dark:hover:text-gray-300 
            @else 
            text-gray-500 hover:text-gray-700 dark:hover:text-gray-200 
            dark:text-gray-400 
            @endif"
        href="{{ $link }}"
    >
        <x-icons.icon name="{{ $icon }}"/>
        <span class="ml-4">{{ $title }}</span>
    </a>
</li>