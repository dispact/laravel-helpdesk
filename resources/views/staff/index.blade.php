<x-app-layout>
    <x-slot name="header">
        {{ __('Manage Staff') }} 
        <button class="text-green-500 hover:text-green-700
            dark:text-green-400 dark:hover:text-green-300"
            onClick="createStaff()">
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
                            <th class="px-4 py-3 text-center">Categories</th>
                            <th class="px-4 py-3 text-center">Buildings</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($allStaff as $staff)
                        <tr id="{{ $staff->id }}" class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 dark:text-gray-200 flex items-center text-sm">
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="object-cover w-full h-full rounded-full"
                                        src="https://i.pravatar.cc/100?u={{ $staff->user->id }}"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <p class="font-semibold dark:text-gray-200">
                                        {{ $staff->user->name }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                                @foreach($staff->categories as $category)
                                    {{ $category->name }}@if(!$loop->last),@endif
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                                @foreach($staff->buildings as $building)
                                    {{ $building->name }}@if(!$loop->last),@endif
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-center space-x-4 dark:text-gray-200">
                                <button class="text-orange-500 hover:text-orange-700 
                                    dark:text-orange-400 dark:hover:text-orange-300"
                                    @click="toggleEditStaffMenu()"
                                    onClick="updateModal({{ $staff->id }})">
                                    <x-icons.icon name="action-edit"/>
                                </button>
                                <button class="text-red-500 hover:text-red-700
                                    dark:text-red-400 dark:hover:text-red-300"
                                    onClick="deleteStaff({{ $staff->id }})">
                                    <x-icons.icon name="action-delete"/>
                                </button>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!$allStaff->count())
                <tr>
                    <p class="dark:text-gray-300 text-center mt-4 font-medium
                        text-gray-600">No staff members available</p>
                </tr>
            @endif
        </div>
        {{ $allStaff->links() }}
        <x-modals.edit-staff/>
    </div>
</x-app-layout>
<script>
function createStaff() {
    Swal.fire({
        title: 'Enter user\'s email',
        input: 'email',
        showCancelButton: true,
        confirmButtonText: 'Update',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'POST',
                url: "{{ route('staff.store') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'email': result.value, 
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

function updateModal(id) {
    var categories = $('tr[id='+id+']').find('td:nth-child(2)').text().trim();
    Array.from(document.querySelector("#category").options).forEach(function(option) {
        option.selected = false;

        let text = option.text;

        if (categories.includes(text))
            option.selected = true;
    });

    var buildings = $('tr[id='+id+']').find('td:nth-child(3)').text().trim();
    Array.from(document.querySelector("#building").options).forEach(function(option) {
        option.selected = false;

        let text = option.text;

        if (buildings.includes(text))
            option.selected = true;
    });

    $('#staff_id').val(id);
}

function deleteStaff(id) {
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
                url: "{{ route('staff.destroy') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'staff_id': id,
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