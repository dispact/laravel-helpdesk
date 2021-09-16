@props(['itemCount', 'noItemsMessage'])

<x-slot name="header">
    {{ $header }}
    <button class="text-green-500 hover:text-green-700
        dark:text-green-400 dark:hover:text-green-300"
        onClick="createItem()">
        <x-icons.icon name="action-create"/>
    </button>
</x-slot>

<div class="max-w-4xl -ml-3 sm:px-6 lg:px-8 pb-6">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left 
                        text-gray-400 uppercase border-b dark:border-gray-700 
                        bg-gray-50 dark:text-gray-500 dark:bg-gray-800"
                    >
                        {{ $columns }}
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    {{ $rows }}
                </tbody>
            </table>
        </div>
        @if (!$itemCount)
            <tr>
                <p class="dark:text-gray-300 text-center mt-4 font-medium
                    text-gray-600">{{ $noItemsMessage }}</p>
            </tr>
        @endif
    </div>
    {{ $links }}
</div>

{{ $scripts }}