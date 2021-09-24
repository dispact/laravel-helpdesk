<label class="block text-xs text-center">
   <span class="text-gray-500 dark:text-gray-400">
      {{ $label }}
   </span>
   <select class="block min-w-35 mt-1 text-xs dark:text-gray-300 dark:border-transparent
      dark:bg-gray-700 focus:border-blue-400 focus:outline-none 
      dark:focus:shadow-outline-gray border px-6 py-2 rounded-lg border-gray-200 text-center
      w-full"
      {{ $attributes }}
   >
      
      <option value="">{{ $default ?? 'All' }}</option>
      
      {{ $slot }}
   </select>
</label>