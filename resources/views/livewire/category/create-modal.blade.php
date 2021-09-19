<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="bookmark"/>
	</x-slot>

	<x-slot name="header">
		Create Category
	</x-slot>

	<x-slot name="fields">
		<x-forms.input label="Name" id="create_name" placeholder="Name" wire:model.defer="name"/>
	</x-slot>

	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>