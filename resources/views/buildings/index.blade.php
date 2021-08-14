<x-app-layout>
    <x-slot name="header">
        {{ __('Manage Buildings') }} 
        <button class="text-green-500 hover:text-green-700
            dark:text-green-400 dark:hover:text-green-300"
            onClick="createBuilding()">
            <x-icons.icon name="action-create"/>
        </button>
    </x-slot>
    
    <div class="max-w-4xl -ml-3 sm:px-6 lg:px-8 pb-6">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left 
                            text-gray-400 uppercase border-b dark:border-gray-700 
                            bg-gray-50 dark:text-gray-500 dark:bg-gray-800"
                        >
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3 text-center">Updated</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($buildings as $building)
                        <tr id="{{ $building->id }}" class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm dark:text-gray-200">
                                {{ $building->name }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                                {{ $building->updated_at->diffForHumans() }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center space-x-4 dark:text-gray-200">
                                <button class="text-orange-500 hover:text-orange-700 
                                    dark:text-orange-400 dark:hover:text-orange-300"
                                    onClick="updateBuilding({{ $building->id }})">
                                    <x-icons.icon name="action-edit"/>
                                </button>
                                <button class="text-red-500 hover:text-red-700
                                    dark:text-red-400 dark:hover:text-red-300"
                                    onClick="deleteBuilding({{ $building->id }})">
                                    <x-icons.icon name="action-delete"/>
                                </button>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!$buildings->count())
                <tr>
                    <p class="dark:text-gray-300 text-center mt-4 font-medium
                        text-gray-600">No buildings available</p>
                </tr>
            @endif
        </div>
        {{ $buildings->links() }}
    </div>

</x-app-layout>
<script>
function createBuilding() {
    Swal.fire({
        title: 'Create building',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Create',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'POST',
                url: "{{ route('buildings.store') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'name': result.value, 
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

function updateBuilding(id) {
    Swal.fire({
        title: 'Update building name',
        input: 'text',
        inputValue: $('tr[id='+id+']').find('td:first').text().trim(),
        showCancelButton: true,
        confirmButtonText: 'Update',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'POST',
                url: "{{ route('buildings.update') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'name': result.value, 
                    'building_id': id,
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

function deleteBuilding(id) {
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
                url: "{{ route('buildings.destroy') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'building_id': id,
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