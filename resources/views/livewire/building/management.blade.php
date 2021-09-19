<x-table.layout 
    itemCount="{{ $buildings->count() }}" 
    noItemsMessage="No Buildings Available" 
    createModal="true"
>
    <x-slot name="header">
        {{ __('Manage Buildings') }}
    </x-slot>

    <x-slot name="columns">
        <th class="px-4 py-3 text-center">Name</th>
        <th class="px-4 py-3 text-center">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($buildings as $building)
        <tr id="{{ $building->id }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $building->name }}
            </td>
            <td class="px-4 py-3 text-sm text-center space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $building->id }}" updateModal="true"/>
            </td>
        </tr> 
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $buildings->links() }}
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
                    Livewire.emit('deleteBuilding', id);
                }
            })
        };
        </script>
    </x-slot>
</x-table.layout>