<x-modal wire:model="show" editModal="true">
   <x-slot name="icon">
      <x-icons.icon name="usergroup"/>
   </x-slot>

   <x-slot name="header">
      Edit User
   </x-slot>

   <x-slot name="fields">
      <x-forms.input 
         label="Name" 
         id="edit_name" 
         placeholder="Name" 
         wire:model.defer="name"/>
      <x-forms.input 
         label="Email" 
         id="edit_email" 
         placeholder="Email address"
         type="email" 
         wire:model.defer="email"
      />
      <x-forms.building-dropdown 
         :identifier="'edit_building'" 
         :label="'Building'"
         :id="'edit_building'" 
         :name="'edit_building'" 
         wire:model.defer="building"
      /> 
   </x-slot>

   <x-slot name="buttonText">
      Update
   </x-slot>
</x-modal>