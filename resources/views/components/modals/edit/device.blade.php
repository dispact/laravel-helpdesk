<x-modals.edit>
    <x-slot name="icon">
        <x-icons.icon name="desktop-computer"/>
    </x-slot>

    <x-slot name="header">
        Edit Device
    </x-slot>

    <x-slot name="fields">
        <x-forms.input label="Asset Tag" id="edit-asset" placeholder="Asset Tag"/>
        <x-forms.model-dropdown :label="'Model'" :identifier="'edit-model'"
            :id="'edit-model'" :name="'edit-model'" 
        />
        <x-forms.building-dropdown :identifier="'edit-building'" :label="'Building'"
            :id="'edit-building'" :name="'edit-building'"
        /> 
        <x-forms.input label="Serial Number" id="edit-serial" 
            placeholder="Serial Number"
        />
        <x-forms.input label="MAC Address" id="edit-mac"
            placeholder="MAC Address"
        />
        <input type="hidden" id="og-asset-tag"/>
    </x-slot>

    <x-slot name="scripts">
        <script>
        function updateEditModalData(id) {
            var model = $('div:contains('+id+').table-cell').parent().find('#device_models').text().trim()
            var building = $('div:contains('+id+').table-cell').parent().find('#buildings').text().trim()
            var serial = $('div:contains('+id+').table-cell').parent().find('#serial_number').text().trim()
            var mac = $('div:contains('+id+').table-cell').parent().find('#mac_address').text().trim()

            Array.from(document.querySelector("#edit-model").options).forEach(function(option) {
                option.selected = false;

                let text = option.text;

                if (text.includes(model))
                    option.selected = true;
            });

            Array.from(document.querySelector("#edit-building").options).forEach(function(option) {
                option.selected = false;

                let text = option.text;

                if (building.includes(text))
                    option.selected = true;
            });

            $('#og-asset-tag').val(id);
            $('#edit-asset').val(id);
            $('#edit-serial').val(serial);
            $('#edit-mac').val(mac);
        }
        
        function update() {
            removeErrorDecor();
            $.ajax({
                method: 'POST',
                url: "{{ route('devices.update') }}",
                data: { 
                    '_token': '@php echo csrf_token(); @endphp',
                    'asset_tag': $('#edit-asset').val(),
                    'model': $('#edit-model').val(),
                    'building': $('#edit-building').val(),
                    'serial_number': $('#edit-serial').val(),
                    'mac_address': $('#edit-mac').val(),
                    'og_asset': $('#og-asset-tag').val()
                },
                dataType: 'json',
                success: function(response) {
                    successResponse(response);
                },
                error: function(response) {
                    errorResponse(response);
                }
            })
        };
        
        function removeErrorDecor() {
            document.getElementById("edit-asset").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("edit-model").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("edit-building").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("edit-serial").classList.remove('border-red-500', 'dark:border-red-400');
            document.getElementById("edit-mac").classList.remove('border-red-500', 'dark:border-red-400');
        };
        </script>
    </x-slot>
</x-modals.edit>