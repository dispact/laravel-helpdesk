<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="identification"/>
	</x-slot>

	<x-slot name="header">
		Create Staff
	</x-slot>

	<x-slot name="fields">
		<x-forms.input 
			label="Email" 
			id="create_email" 
			placeholder="Email address"
			type="email" 
			wire:model.defer="email"
       />
		<x-forms.category-select 
			:identifier="'create_category'" 
			:label="'Assigned Categories'"
			:name="'edit_category'" 
			:val="''" 
			wire:model.defer="category"
		/> 
		<x-forms.building-select 
			:identifier="'create_building'" 
			:label="'Assigned Buildings'"
			:name="'edit_building'" 
			:val="''" 
			wire:model.defer="building"
		/> 
		<input 
			type="hidden" 
			id="staff_id" 
			value=""
		/>
	</x-slot>

	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>