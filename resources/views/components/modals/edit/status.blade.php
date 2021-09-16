<x-modals.edit>
    <x-slot name="icon">
       <x-icons.icon name="desktop-computer"/>
    </x-slot>
 
    <x-slot name="header">
       Edit User
    </x-slot>
 
    <x-slot name="fields">
        <x-forms.input label="Name" id="edit_name" placeholder="Name"/>
        <x-forms.select-array label="Color" id="edit_color" 
            :items="config('enum.status_colors')"
        /> 
        <input type="hidden" id="status_id" val=""/>
    </x-slot>
 
    <x-slot name="scripts">
       <script>
       function updateStatus() {
            removeEditErrorDecor();
            $.ajax({
                method: 'POST',
                url: "{{ route('status.update') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'name': $('#edit_name').val(),
                    'color': $('#edit_color').val(),
                    'status': $('#status_id').val()
                },
                dataType: 'json',
                success: function(response) {
                    successResponse(response);
                },
                error: function(response) {
                    errorResponse(response);
                }
            })
        }


        function removeEditErrorDecor() {
            document.getElementById("edit_name").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("edit_color").classList.remove('border-red-500', 'dark:border-red-400');
        }
       </script>
    </x-slot>
 </x-modals.edit>