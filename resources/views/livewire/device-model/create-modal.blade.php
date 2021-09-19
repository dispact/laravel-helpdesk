<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="desktop-computer"/>
	</x-slot>

	<x-slot name="header">
		Create Device Model
	</x-slot>

	<x-slot name="fields">
		<x-forms.input 
			label="Name" 
			id="create_name" 
			placeholder="Name"
			wire:model.defer="name"
		/>
		<x-forms.select 
			label="Manufacturer" 
			:items="config('enum.manufacturers')"
			id="create_manufacturer" 
			identifier="create_manufacturer" 
			name="create_manufacturer"
			enum="true"
			wire:model.defer="manufacturer"
		/>
		<x-forms.select 
			label="Type" 
			:items="config('enum.model_types')"
			id="create_type" 
			identifier="create_type" 
			name="create_type"
			enum="true"
			wire:model.defer="type"
		/>
	</x-slot>

	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>