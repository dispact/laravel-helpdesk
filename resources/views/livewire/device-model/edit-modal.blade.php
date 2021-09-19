<x-modal wire:model="show" updateModal="true">
	<x-slot name="icon">
		<x-icons.icon name="desktop-computer"/>
	</x-slot>

	<x-slot name="header">
		Edit Device Model
	</x-slot>

	<x-slot name="fields">
		<x-forms.input 
			label="Name" 
			id="edit_name" 
			placeholder="Name"
			wire:model.defer="name"
		/>
		<x-forms.select 
			label="Manufacturer" 
			:items="config('enum.manufacturers')"
			id="edit_manufacturer" 
			identifier="edit_manufacturer" 
			name="edit_manufacturer"
			enum="true"
			wire:model.defer="manufacturer"
		/>
		<x-forms.select 
			label="Type" 
			:items="config('enum.model_types')"
			id="edit_type" 
			identifier="edit_type" 
			name="edit_type"
			enum="true"
			wire:model.defer="type"
		/>
	</x-slot>

	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>