<x-modals.create>
    <x-slot name="icon">
       <x-icons.icon name="annotation"/>
    </x-slot>
 
    <x-slot name="header">
       Create Status
    </x-slot>
 
    <x-slot name="fields">
        <x-forms.input label="Name" id="create_name" placeholder="Name"/>
        <x-forms.select-array label="Color" id="create_color" 
            :items="config('enum.status_colors')"
        /> 
    </x-slot>
 
    <x-slot name="scripts">
       <script>
       function create() {
            removeCreateErrorDecor();
            $.ajax({
                method: 'POST',
                url: "{{ route('status.store') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'name': $('#create_name').val(),
                    'color': $('#create_color').val()
                },
                dataType: 'json',
                success: function(response) {
                    swal_success(response['msg']);
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                },
                error: function(response) {
                    console.log(response.responseJSON);
                    if (response.responseJSON.errors)
                        
                        jQuery.each(response.responseJSON.errors, function(i, val) {
                            addErrorDecor(i);
                        });
                    swal_error(response.responseJSON.msg);
                }
            })
        }

        function removeCreateErrorDecor() {
            document.getElementById("create_name").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("create_color").classList.remove('border-red-500', 'dark:border-red-400');
        }
       </script>
    </x-slot>
 </x-modals.create>