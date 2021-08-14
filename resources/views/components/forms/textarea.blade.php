@props(['label' => '', 'placeholder' => '', 'id' => '', 'name' => $id])
<label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-300">{{ $label }}</span>
    <textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 
        dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none 
        focus:shadow-outline-purple dark:focus:shadow-outline-gray border px-4 py-2 
        rounded-lg border-gray-200
        @error($id) border-red-500 dark:border-red-400 @enderror"
        rows="3"
        placeholder="{{ $placeholder }}"
        id="{{ $id }}"
        name="{{ $name }}"
    ></textarea>
    @error($id)
        <span class="text-xs text-red-600 dark:text-red-400">
            {{ $message }}
        </span>
    @enderror
</label>