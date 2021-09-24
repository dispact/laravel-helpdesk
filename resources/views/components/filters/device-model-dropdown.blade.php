<x-filters.dropdown :attributes="$attributes">
	<x-slot name="label">
	   Model
	</x-slot>
 
	@foreach($models as $model)
		<option value="{{ $model->id }}">{{ $model->name }}</option>
	@endforeach
</x-filters.dropdown>