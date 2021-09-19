<x-table.layout 
    itemCount="{{ $models->count() }}" 
    noItemsMessage="No Device Models Available"
    createModal="true"
>
    <x-slot name="header">
        {{ __('Manage Device Models') }}
    </x-slot>

    <x-slot name="columns">
        <th class="px-4 py-3 text-center">Name</th>
        <th class="px-4 py-3 text-center">Manufacturer</th>
        <th class="px-4 py-3 text-center">Type</th>
        <th class="px-4 py-3 text-center">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($models as $model)
        <tr id="{{ $model->id }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $model->name }}
            </td>
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $model->getModelManufacturerAttribute($model->manufacturer) }}
            </td>
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $model->getModelTypeAttribute($model->type) }}
            </td>
            <td class="px-4 py-3 text-sm text-center space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $model->id }}" updateModal="true"/>
            </td>
        </tr> 
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $models->links() }}
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
                    Livewire.emit('deleteDeviceModel', id);
                }
            })
        };
        </script>
    </x-slot>
</x-table.layout>