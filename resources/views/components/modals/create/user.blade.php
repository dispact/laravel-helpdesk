<x-modals.create>
   <x-slot name="icon">
      <x-icons.icon name="desktop-computer"/>
   </x-slot>

   <x-slot name="header">
      Create User
   </x-slot>

   <x-slot name="fields">
      <x-forms.input label="Name" id="create_name" placeholder="Name"/>
      <x-forms.input label="Email" id="create_email" placeholder="Email address"
         type="email"
      />
      <x-forms.input label="Password" id="password" type="password" 
         placeholder="Password"
      />
      <x-forms.input label="Confirm password" id="password_confirmation"
         type="password" placeholder="Confirm Password"
      />
      <x-forms.building-dropdown :identifier="'create_building'" :label="'Building'"
         :id="'create_building'" :name="'create_building'"
      /> 
   </x-slot>

   <x-slot name="scripts">
      <script>
      function create() {
         removeCreateErrorDecor();
         $.ajax({
            method: 'POST',
            url: "{{ route('users.store') }}",
            data: { 
                  '_token': '@php echo csrf_token(); @endphp',
                  'name': $('#create_name').val(),
                  'email': $('#create_email').val(),
                  'building': $('#create_building').val(),
                  'password': $('#password').val(),
                  'password_confirmation': $('#password_confirmation').val()
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

      function removeCreateErrorDecor() {
         document.getElementById("create_name").classList.remove('border-red-500', 'dark:border-red-400');
         document.getElementById("create_email").classList.remove('border-red-500', 'dark:border-red-400');
         document.getElementById("password").classList.remove('border-red-500', 'dark:border-red-400');
         document.getElementById("create_building").classList.remove('border-red-500', 'dark:border-red-400');
      }
      </script>
   </x-slot>
</x-modals.create>