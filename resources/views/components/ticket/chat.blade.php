<div class="flex antialiased text-gray-800">
    <div class="md:flex overflow-x-hidden w-full max-h-96 sm:grid sm:grid-cols-1">
        <div class="flex flex-col flex-auto pr-0 md:pr-4">
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 dark:bg-gray-700 h-full">
                <div class="flex flex-col h-full overflow-x-auto overflow-y-scroll mb-4 p-4 min-h-100
                    scrollbar scrollbar-thumb-blue-500 scrollbar-track-gray-100">
                    <div class="flex flex-col h-full">
                        <div class="grid grid-cols-12 gap-y-2">
                            @foreach($messages as $message)
                                @if ($message->author == auth()->user())
                                    <x-ticket.right-chat :message="$message"/>
                                @else
                                    <x-ticket.left-chat :message="$message"/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
    
                <div class="flex flex-row items-center h-16 bg-gray-200 
                    dark:bg-gray-800 w-full px-4 py-4 rounded-b-2xl">
                    <div class="flex-grow ml-2">
                        <div class="relative w-full">
                            <input type="text" id="message_content" name="message_content"
                                class="flex w-full border dark:border-gray-700 rounded-xl 
                                focus:outline-none dark:bg-gray-600 dark:text-gray-100 
                                focus:border-blue-300 pl-4 h-10 border-gray-300
                                dark:focus:border-blue-600"
                            />
                        </div>
                    </div>
                    <div class="ml-4">
                        <button class="flex items-center justify-center bg-blue-500 dark:bg-blue-600
                            hover:bg-blue-600 rounded-xl text-white px-4 py-1 flex-shrink-0
                            dark:hover:bg-blue-700"
                            onClick="submitMessage()"
                        >
                            <span>Send</span>
                            <span class="ml-2">
                                <x-icons.icon name="message"/>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- <x-ticket.author/> --}}
     
    </div>
</div>

<script>
function submitMessage() {
    var message = $('#message_content').val();
    if (message == '') {
        Swal.fire({
            icon: 'error',
            title: 'You forgot to type a message!',
            showConfirmationButton: false,
			timer: 2000
        });
    } else {
        $.ajax({
            type: 'POST',
            url: '{{ route("messages.store") }}',
            data: {
                '_token': '@php echo csrf_token(); @endphp',
                'ticket_id': '{{ request()->ticket->id }}',
                'content': $('#message_content').val()
            },
            dataType: 'json',
            success: function(response) {
                window.dispatchEvent(new CustomEvent('successMessage', { detail: { message: response['msg'] }}));
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            },
            error: function(response) {
                window.dispatchEvent(new CustomEvent('successMessage', { detail: { message: response.responseJSON.msg }}));
            }
        });
    }
}
</script>