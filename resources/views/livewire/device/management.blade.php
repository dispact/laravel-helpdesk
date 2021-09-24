{{-- 
    Asset Tag, Model, Building, Serial Number, Mac Address, Actions    
--}}
<x-table.layout 
    itemCount="{{ $devices->count() }}" 
    noItemsMessage="No Devices Available"
    createModal="true"
    tableWidth="max-w-6xl"
>
    <x-slot name="header">
        {{ __('Manage Devices') }}
    </x-slot>

    <x-slot name="searchBar">
        <x-filters.device-model-dropdown wire:model="model"/>
        <x-filters.building-dropdown wire:model="building"/>
        <x-forms.search-input 
            wire:model.debounce.500ms="search" 
            placeholder="Search tag, serial, mac..."/>
    </x-slot>

    <x-slot name="columns">
        <th class="px-4 py-3 text-center">
            <div class="flex items-center justify-center cursor-pointer" wire:click="sortBy('asset_tag')">
                Asset Tag
                <x-sort-icon 
                    field="asset_tag"
                    :sortField="$sortField" 
                    :sortAsc="$sortAsc"
                />
            </div>
        </th>
        <th class="px-4 py-3 text-center">Model</th>
        <th class="px-4 py-3 text-center">Building</th>
        <th class="px-4 py-3 text-center">
            <div class="flex items-center justify-center cursor-pointer" wire:click="sortBy('serial_number')">
                Serial Number
                <x-sort-icon 
                    field="serial_number"
                    :sortField="$sortField" 
                    :sortAsc="$sortAsc"
                />
            </div>
        </th>
        <th class="px-4 py-3 text-center">
            <div class="flex items-center justify-center cursor-pointer" wire:click="sortBy('mac_address')">
                MAC Address
                <x-sort-icon 
                    field="mac_address"
                    :sortField="$sortField" 
                    :sortAsc="$sortAsc"
                />
            </div>
        </th>
        <th class="px-4 py-3 text-center w-40">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($devices as $device)
        <tr id="{{ $device->asset_tag }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $device->asset_tag }}
            </td>
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $device->model->name ?? ''}}
            </td>
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $device->building->name ?? ''}}
            </td>
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $device->serial_number ?? ''}}
            </td>
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $device->mac_address ?? ''}}
            </td>
            <td class="px-4 py-3 text-sm text-center space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $device->asset_tag }}" updateModal="true"/>
            </td>
        </tr> 
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $devices->links() }}
    </x-slot>

    <x-slot name="scripts">
        <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to reverse this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteDevice', id);
                }
            })
        };
        </script>
    </x-slot>
</x-table.layout>