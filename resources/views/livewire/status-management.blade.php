<x-table.layout itemCount="{{ $statuses->count() }}" 
    noItemsMessage="No statuses available"
>
    <x-slot name="header">
        {{ __('Manage Statuses') }}
    </x-slot>

    <x-slot name="columns">
        <th class="px-4 py-3 text-center">Name</th>
        <th class="px-4 py-3 text-center">Color</th>
        <th class="px-4 py-3 text-center">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($statuses as $status)
        <tr id="{{ $status->id }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                <span class="px-2 py-1 font-semibold leading-tight text-{{ $status->getStatusColorAttribute($status->color) }}-700 
                    bg-{{ $status->getStatusColorAttribute($status->color) }}-100 rounded-full dark:bg-{{ $status->getStatusColorAttribute($status->color) }}-700 dark:text-{{ $status->getStatusColorAttribute($status->color) }}-100"
                >
                    {{ ucwords($status->name) }}
                </span>
            </td>
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $status->getStatusColorAttribute($status->color) }}
            </td>
            <td class="px-4 py-3 text-sm text-center space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $status->id }}"/>
            </td>
        </tr> 
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $statuses->links() }}
    </x-slot>

    <x-slot name="scripts">
        <script>
        function updateModal(id) {
            var name = $('tr[id='+id+']').find('td:nth-child(1)').text().trim();
            var color = $('tr[id='+id+']').find('td:nth-child(2)').text().trim();
            Array.from(document.querySelector("#edit_color").options).forEach(function(option) {
                option.selected = false;

                let text = option.text;

                if (color.includes(text))
                    option.selected = true;
            });

            $('#status_id').val(id);
            $('#edit_name').val(name);
        }

        function deleteStatus(id) {
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
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('status.destroy') }}",
                        data: { 
                            '_token': '@php echo csrf_token(); @endphp',
                            'status': id,
                        },
                        dataType: 'json',
                        success: function(response) {
                            swal_success(response['msg']);
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        },
                        error: function(response) {
                            swal_error(response.responseJSON['msg']);
                        }
                    })
                }
            })
        }
        </script>
    </x-slot>
</x-table.layout>