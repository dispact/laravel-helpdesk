<x-modal wire:model="show" editModal="true">
	<x-slot name="icon">
		<x-icons.icon name="annotation"/>
	</x-slot>

	<x-slot name="header">
		Edit Status
	</x-slot>

	<x-slot name="fields">
		<x-forms.input label="Name" id="edit_name" placeholder="Name" wire:model.defer="name"/>
		<x-forms.select-array label="Color" id="edit_color" 
			:items="config('enum.status_colors')" wire:model.defer="color"
		/> 
	</x-slot>

	<x-slot name="buttonText">
		Update
	</x-slot>
</x-modal>