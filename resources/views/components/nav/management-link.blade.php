@props(['title' => '', 'link' => '', 'active' => false])
<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
    @if($active) text-gray-600 dark:text-gray-200 font-bold @endif">
    <a class="inline-block w-full" href="{{ $link }}">{{ $title }}</a>
</li>