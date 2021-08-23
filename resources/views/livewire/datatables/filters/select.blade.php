<div x-data class="flex flex-col py-1">
    <div class="flex">
        <select
            x-ref="select"
            name="{{ $name }}"
            class="w-full m-1 text-sm leading-4 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-cool-gray-600 dark:border-cool-gray-500"
            wire:input="doSelectFilter('{{ $index }}', $event.target.value)"
            x-on:input="$refs.select.value=''"
        >
            <option value=""></option>
            @foreach($options as $value => $label)
            @if(is_object($label))
            <option value="{{ $label->id }}">{{ $label->name }}</option>
            @elseif(is_array($label))
            <option value="{{ $label['id'] }}">{{ $label['name'] }}</option>
            @elseif(is_numeric($value))
            <option value="{{ $label }}">{{ $label }}</option>
            @else
            <option value="{{ $value }}">{{ $label }}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="flex flex-wrap max-w-48 space-x-1">
        @foreach($this->activeSelectFilters[$index] ?? [] as $key => $value)
        <button wire:click="removeSelectFilter('{{ $index }}', '{{ $key }}')" x-on:click="$refs.select.value=''"
            class="m-1 pl-1 pr-1 mb-1 flex items-center uppercase tracking-wide bg-cool-gray-400 dark:bg-cool-gray-500 text-gray-700 dark:text-white hover:bg-red-500 dark:hover:bg-red-400 hover:text-white dark:hover:text-black rounded-full focus:outline-none text-xs space-x-1">
            <span class="p-1">{{ $this->getDisplayValue($index, $value) }}</span>
            <x-icons.x-circle />
        </button>
        @endforeach
    </div>
</div>
