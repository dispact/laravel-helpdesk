<x-filters.dropdown :attributes="$attributes">
	<x-slot name="label">
		Staff
	</x-slot>

	<x-slot name="default">
		Me
	</x-slot>

	@foreach($staff as $staff)
		<option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
	@endforeach
</x-filters.dropdown>