<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="desktop-computer"/>
	</x-slot>

	<x-slot name="header">
		Create Device
	</x-slot>

	<x-slot name="fields">
		<x-forms.input 
			label="Asset Tag" 
			id="create_asset_tag" 
			placeholder="Asset Tag"
			wire:model.defer="assetTag"
		/>
		<x-forms.model-dropdown 
			:identifier="'create_model'" 
			:label="'Model'"
			:id="'create_model'" 
			:name="'create_model'" 
			wire:model.defer="deviceModel"
		/>
		<x-forms.building-dropdown 
			:identifier="'create_building'" 
			:label="'Building'"
			:id="'create_building'" 
			:name="'create_building'"
			wire:model.defer="building"
		/> 
		<x-forms.input 
			label="Serial Number" 
			id="create_serial_number" 
			placeholder="Serial Number"
			wire:model.defer="serialNumber"
		/>
		<x-forms.input 
			label="MAC Address" 
			id="create_mac_address"
			placeholder="MAC Address"
			wire:model.defer="macAddress"
		/>
	</x-slot>

	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>