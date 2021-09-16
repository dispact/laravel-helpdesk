<x-modals.edit>
   <x-slot name="icon">
      <x-icons.icon name="desktop-computer"/>
   </x-slot>

   <x-slot name="header">
      Edit User
   </x-slot>

   <x-slot name="fields">
      <x-forms.input label="Name" id="edit_name" placeholder="Name"/>
      <x-forms.input label="Email" id="edit_email" placeholder="Email address"
         type="email"
      />
      <x-forms.building-dropdown :identifier="'edit_building'" :label="'Building'"
         :id="'edit_building'" :name="'edit_building'"
      /> 
      <input type="hidden" id="user_id" value=""/>
   </x-slot>

   <x-slot name="scripts">
      <script>
      function update() {
         removeErrorDecor();
         $.ajax({
            method: 'POST',
            url: "{{ route('users.update') }}",
            data: { 
                  '_token': '@php echo csrf_token(); @endphp',
                  'name': $('#edit_name').val(),
                  'email': $('#edit_email').val(),
                  'building': $('#edit_building').val(),
                  'user_id': $('#user_id').val()
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
      }

      function addErrorDecor(obj_id) {
         document.getElementById(obj_id).classList.add('border-red-500', 'dark:border-red-400');
      }

      function removeErrorDecor() {
         document.getElementById("edit_name").classList.remove('border-red-500', 'dark:border-red-400');
         document.getElementById("edit_email").classList.remove('border-red-500', 'dark:border-red-400');
         document.getElementById("edit_building").classList.remove('border-red-500', 'dark:border-red-400');
      }
      </script>
   </x-slot>
</x-modals.edit>