<div x-data class="flex flex-col py-1">
    <input
        x-ref="input"
        type="text"
        class="m-1 text-sm leading-4 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-cool-gray-600 dark:border-cool-gray-500 dark:text-gray-300"
        wire:change="doTextFilter('{{ $index }}', $event.target.value)"
        x-on:change="$refs.input.value = ''"
    />
    <div class="flex flex-wrap max-w-48 space-x-1">
        @foreach($this->activeTextFilters[$index] ?? [] as $key => $value)
        <button wire:click="removeTextFilter('{{ $index }}', '{{ $key }}')" class="m-1 pl-1 pr-1 mb-1 flex items-center uppercase tracking-wide bg-cool-gray-400 dark:bg-cool-gray-500 text-gray-700 dark:text-white hover:bg-red-500 hover:text-white dark:hover:text-black dark:hover:bg-red-400 rounded-full focus:outline-none text-xs space-x-1">
            <span class="p-1">{{ $this->getDisplayValue($index, $value) }}</span>
            <x-icons.x-circle />
        </button>
        @endforeach
    </div>
</div>
