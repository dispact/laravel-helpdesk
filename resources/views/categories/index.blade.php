<x-table.layout itemCount="{{ $categories->count() }}" 
    noItemsMessage="No categories available"
>
    <x-slot name="header">
        {{ __('Manage Categories') }}
    </x-slot>

    <x-slot name="columns">
        <th class="px-4 py-3 text-center">Name</th>
        <th class="px-4 py-3 text-center">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($categories as $category)
        <tr id="{{ $category->id }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                {{ $category->name }}
            </td>
            <td class="px-4 py-3 text-sm text-center space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $category->id }}"/>
            </td>
        </tr> 
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $categories->links() }}
    </x-slot>

    <x-slot name="scripts">
        <script>
        function createItem() {
            Swal.fire({
                title: 'Create category',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Create',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('categories.store') }}",
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

        function updateItem(id) {
            Swal.fire({
                title: 'Update category name',
                input: 'text',
                inputValue: $('tr[id='+id+']').find('td:first').text().trim(),
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('categories.update') }}",
                        data: { 
                            '_token': '@php echo csrf_token(); @endphp',
                            'name': result.value, 
                            'category_id': id,
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
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('categories.destroy') }}",
                        data: { 
                            '_token': '@php echo csrf_token(); @endphp',
                            'category_id': id,
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