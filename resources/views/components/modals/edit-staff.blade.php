<div>

    <div class="fixed z-50 inset-0 overflow-y-auto m-auto" aria-labelledby="modal-title" 
        role="dialog" aria-modal="true" x-show="isEditStaffMenuOpen" x-cloak
    >
        
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity
                dark:bg-gray-800 dark:bg-opacity-80" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-700 rounded-lg text-left 
                    overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle 
                    sm:max-w-lg sm:w-full ring-gray-500 ring-2 ring-opacity-10 m-auto" 
                @click.away="toggleEditStaffMenu()" 
                @close.stop="toggleEditStaffMenu()"
                x-on:keydown.escape="toggleEditStaffMenu()"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
            >
                <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center 
                                justify-center h-12 w-12 rounded-full bg-orange-100 dark:bg-orange-200
                                sm:mx-0 sm:h-10 sm:w-10 text-orange-500 dark:text-orange-600"
                        >
                            <x-icons.icon name="identification"/>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            
                            <h3 class="text-lg leading-6 font-medium text-gray-900
                                dark:text-gray-200 mt-2">
                                Edit Staff Details
                            </h3>

                            <div class="mt-2 w-full">
                                <x-forms.category-select :identifier="'category'" :label="'Assigned Categories'"
                                    :name="'category'" :val="''"/> 
                                <x-forms.building-select :identifier="'building'" :label="'Assigned Buildings'"
                                    :name="'building'" :val="''"/> 
                                <input type="hidden" id="staff_id" value=""/>
                                <input type="hidden" id="category_id" val=""/>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button class="w-full inline-flex justify-center 
                        rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 
                        text-base font-medium text-white hover:bg-blue-700 focus:outline-none 
                        focus:ring-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                        onClick="updateStaff()"
                    >
                        Update
                    </button>
                    <button @click="toggleEditStaffMenu()" class="mt-3 w-full inline-flex justify-center rounded-md border 
                        border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white 
                        dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 
                        hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 
                        focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>  
</div>

<script>
function updateStaff() {
    $.ajax({
        method: 'POST',
        url: "{{ route('staff.update') }}",
        data: { 
            '_token': '@php echo csrf_token(); @endphp',
            'staff_id': $('#staff_id').val(),
            'category_id': $('#category').val(),
            'building_id': $('#building').val()
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
</script>