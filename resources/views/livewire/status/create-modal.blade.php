<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="annotation"/>
	</x-slot>

	<x-slot name="header">
		Create Status
	</x-slot>

	<x-slot name="fields">
		<x-forms.input label="Name" id="create_name" placeholder="Name" wire:model.defer="name"/>
		<x-forms.select-array label="Color" id="create_color" 
			:items="config('enum.status_colors')" wire:model.defer="color"
		/> 
	</x-slot>

	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>