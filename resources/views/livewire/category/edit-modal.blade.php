<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="bookmark"/>
	</x-slot>

	<x-slot name="header">
		Edit Building
	</x-slot>

	<x-slot name="fields">
		<x-forms.input label="Name" id="edit_name" placeholder="Name" wire:model.defer="name"/>
	</x-slot>

	<x-slot name="buttonText">
		Update
	</x-slot>
</x-modal>