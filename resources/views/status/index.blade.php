
<x-app-layout>
    <x-slot name="header">
        {{ __('Manage Status') }} 
        <button class="text-green-500 hover:text-green-700
            dark:text-green-400 dark:hover:text-green-300"
            @click="toggleCreateStatusMenu()">
            <x-icons.icon name="action-create"/>
        </button>
    </x-slot>

    <div class="max-w-3xl ml-3 md:-ml-3 sm:px-6 lg:px-8 pb-6">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left 
                            text-gray-400 uppercase border-b dark:border-gray-700 
                            bg-gray-50 dark:text-gray-500 dark:bg-gray-800"
                        >
                            <th class="px-4 py-3 text-center">Name</th>
                            <th class="px-4 py-3 text-center">Color</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
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
                                <button class="text-orange-500 hover:text-orange-700 
                                    dark:text-orange-400 dark:hover:text-orange-300"
                                    @click="toggleEditStatusMenu()"
                                    onClick="updateModal({{ $status->id }})">
                                    <x-icons.icon name="action-edit"/>
                                </button>
                                <button class="text-red-500 hover:text-red-700
                                    dark:text-red-400 dark:hover:text-red-300"
                                    onClick="deleteStatus({{ $status->id }})">
                                    <x-icons.icon name="action-delete"/>
                                </button>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!$statuses->count())
                <tr>
                    <p class="dark:text-gray-300 text-center mt-4 font-medium
                        text-gray-600">No statuses available</p>
                </tr>
            @endif
        </div>
        {{ $statuses->links() }}
        <x-create-status/>
        <x-edit-status/>
    </div>
</x-app-layout>

<script>
function updateModal(id) {
    var name = $('tr[id='+id+']').find('td:nth-child(1)').text().trim();
    var color = $('tr[id='+id+']').find('td:nth-child(2)').text().trim();
    Array.from(document.querySelector("#edit-color").options).forEach(function(option) {
        option.selected = false;

        let text = option.text;

        if (color.includes(text))
            option.selected = true;
    });

    $('#status_id').val(id);
    $('#edit-name').val(name);
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