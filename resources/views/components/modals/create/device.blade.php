<x-modals.create>
    <x-slot name="icon">
        <x-icons.icon name="desktop-computer"/>
    </x-slot>

    <x-slot name="header">
        Add Device
    </x-slot>

    <x-slot name="fields">
        <x-forms.input label="Asset Tag" id="create_asset_tag" placeholder="Asset Tag"/>
        <x-forms.model-dropdown :identifier="'create_model'" :label="'Model'"
            :id="'create_model'" :name="'create_model'" 
        />
        <x-forms.building-dropdown :identifier="'create_building'" :label="'Building'"
            :id="'create_building'" :name="'create_building'"
        /> 
        <x-forms.input label="Serial Number" id="create_serial_number" 
            placeholder="Serial Number"
        />
        <x-forms.input label="MAC Address" id="create_mac_address"
            placeholder="MAC Address"
        />
    </x-slot>

    <x-slot name="scripts">
        <script>
        function create() {
            removeCreateErrorDecor();
            $.ajax({
                method: 'POST',
                url: "{{ route('devices.store') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'asset_tag': $('#create_asset_tag').val(),
                    'model': $('#create_model').val(),
                    'building': $('#create_building').val(),
                    'serial_number': $('#create_serial_number').val(),
                    'mac_address': $('#create_mac_address').val()
                },
                dataType: 'json',
                success: function(response) {
                    swal_success(response['msg']);
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                },
                error: function(response) {
                    if (response.responseJSON['errors'])
                        jQuery.each(response.responseJSON['errors'], function(i, val) {
                            addErrorDecor(i);
                        });
                    swal_error(response.responseJSON['msg']);
                }
            })
        };

        function removeCreateErrorDecor() {
            document.getElementById("create_asset_tag").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("create_model").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("create_building").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("create_serial_number").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("create_mac_address").classList.remove('border-red-500', 'dark:border-red-400');
        };
        </script>
    </x-slot>
</x-modals.create>