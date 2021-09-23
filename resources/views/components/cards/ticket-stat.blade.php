@props(['name' => '', 'stat' => '', 'color' => 'gray'])
<div class="bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4 px-4 py-2 rounded-lg shadow-xs">
    <div>
        <p class="text-md font-semibold text-gray-500 dark:text-gray-400 text-center">
            {{ $name }}
        </p>
        <p class="dark:text-{{ $color }}-200 font-normal 
            text-{{ $color }}-600 text-lg text-center"
        >
           {{ $slot }}
        </p>
    </div>
</div>