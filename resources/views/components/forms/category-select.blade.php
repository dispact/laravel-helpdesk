@props(['label' => '', 'id' => '', 'name' => '', 'val' => ''])
<label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-300">
        {{ $label }}
    </span>
    <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 
            dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple 
            dark:focus:shadow-outline-gray border px-4 py-2 rounded-lg border-gray-200
            @error($id) border-red-500 dark:border-red-400 @enderror"
            id="{{ $id }}"
            name="{{ $name }}"
            multiple
            {{ $attributes }}
    >
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error($id)
        <span class="text-xs text-red-600 dark:text-red-400">
            {{ $message }}
        </span>
    @enderror
</label>