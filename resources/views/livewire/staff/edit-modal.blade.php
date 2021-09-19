<x-modal wire:model="show" editModal="true">
	<x-slot name="icon">
		<x-icons.icon name="identification"/>
	</x-slot>

	<x-slot name="header">
		Edit Staff Details
	</x-slot>

	<x-slot name="fields">
		<x-forms.category-select :identifier="'edit_category'" :label="'Assigned Categories'"
			:name="'edit_category'" :val="''" wire:model.defer="category"
		/> 
		<x-forms.building-select :identifier="'edit_building'" :label="'Assigned Buildings'"
			:name="'edit_building'" :val="''" wire:model.defer="building"
		/> 
		<input type="hidden" id="staff_id" value=""/>
	</x-slot>

	<x-slot name="buttonText">
		Update
	</x-slot>
</x-modal>