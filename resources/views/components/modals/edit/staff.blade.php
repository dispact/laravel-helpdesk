<x-modals.edit>
    <x-slot name="icon">
        <x-icons.icon name="identification"/>
    </x-slot>

    <x-slot name="header">
        Edit Staff Details
    </x-slot>

    <x-slot name="fields">
        <x-forms.category-select :identifier="'edit_category'" :label="'Assigned Categories'"
            :name="'edit_category'" :val="''"
        /> 
        <x-forms.building-select :identifier="'edit_building'" :label="'Assigned Buildings'"
            :name="'edit_building'" :val="''"
        /> 
        <input type="hidden" id="staff_id" value=""/>
        <input type="hidden" id="category_id" val=""/>
    </x-slot>

    <x-slot name="scripts">
        <script>
            function update() {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('staff.update') }}",
                    data: { 
                        '_token': '@php echo csrf_token(); @endphp',
                        'staff_id': $('#staff_id').val(),
                        'category_id': $('#edit_category').val(),
                        'building_id': $('#edit_building').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        successResponse(response);
                    },
                    error: function(response) {
                        swal_error(response.responseJSON.msg);
                    }
                })
            };
        </script>
    </x-slot>
</x-modals.edit>