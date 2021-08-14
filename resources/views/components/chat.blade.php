@props(['messages', 'ticket', 'recentTickets'])
<div class="flex antialiased text-gray-800">
    <div class="flex flex-row-reverse overflow-x-hidden w-full max-h-90">
        
        <div class="flex flex-col py-8 pl-6 pr-6 w-64 bg-gray-100 
            dark:bg-gray-700 flex-shrink-0 rounded-2xl">
            <div class="flex flex-col items-center mt-4 w-full px-4 rounded-lg">
                <div class="h-20 w-20 rounded-full overflow-hidden">
                    <img src="https://i.pravatar.cc/100?u={{ $ticket->author->id }}"
                        alt="Avatar"
                        class="h-full w-full"
                    />
                </div>
                <div class="text-sm font-semibold mt-2 dark:text-gray-200">{{ $ticket->author->name }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-300">{{ $ticket->author->email }}</div>   
            </div>
            <div class="flex flex-col mt-8">
                <div class="flex flex-row items-center justify-between">
                    <span class="font-bold dark:text-gray-200 text-sm">Recent Tickets</span>
                    <span class="flex items-center justify-center bg-gray-300 text-xs
                        dark:bg-gray-600 dark:text-gray-200 font-medium h-5 w-5 rounded-full"
                    >
                        {{ $recentTickets->count() }}
                    </span>
                </div>
                @if ($recentTickets->count())
                <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48 overflow-y-auto">
                    @foreach($recentTickets as $ticket)
                    <a class="flex flex-row items-center hover:bg-gray-200 
                        dark:hover:bg-gray-500 dark:hover:text-gray-700
                        rounded-xl p-2 cursor-pointer"
                        href="{{ route('tickets.show', $ticket->id) }}">
                        <div class="ml-2 text-sm font-semibold dark:text-gray-200">
                            <p class="line-clamp-1">{{ $ticket->title }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                    <p class="ml-2 mt-2 text-sm font-medium dark:text-gray-400">No other tickets</p>
                @endif
            </div>
        </div>

        <div class="flex flex-col flex-auto pr-6">
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 
                dark:bg-gray-700 h-full">
                <div class="flex flex-col h-full overflow-x-auto mb-4 p-4">
                    <div class="flex flex-col h-full">
                        <div class="grid grid-cols-12 gap-y-2">
                            @foreach($messages as $message)
                                @if ($message->author == auth()->user())
                                    <x-right-chat :message="$message"/>
                                @else
                                    <x-left-chat :message="$message"/>
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
                'ticket_id': '{{ $ticket->id }}',
                'content': $('#message_content').val()
            },
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: response['msg'],
                    showConfirmationButton: false,
			        timer: 2000
                });
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: response.responseJSON['msg'],
                    showConfirmationButton: false,
			        timer: 2000
                });
            }
        });
    }
}
</script>