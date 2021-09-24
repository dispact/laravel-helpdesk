<x-filters.dropdown :attributes="$attributes">
   <x-slot name="label">
      Building
   </x-slot>

   @foreach($buildings as $building)
      <option value="{{ $building->id }}">{{ $building->name }}</option>
   @endforeach
</x-filters.dropdown>