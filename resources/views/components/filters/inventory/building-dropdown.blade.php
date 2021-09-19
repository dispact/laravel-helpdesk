<label class="block text-xs text-center">
   <span class="text-gray-500 dark:text-gray-400">
      Building
   </span>
   <select class="block min-w-35 mt-1 text-xs dark:text-gray-300 dark:border-gray-600 
      dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple 
      dark:focus:shadow-outline-gray border px-4 py-2 rounded-lg border-gray-200 text-center"
      {{ $attributes }}
   >
      
      <option value="">All</option>
      
      @foreach($buildings as $building)
         <option value="{{ $building->id }}">{{ $building->name }}</option>
      @endforeach
   </select>
</label>