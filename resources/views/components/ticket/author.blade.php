<div class="flex flex-col mt-4 md:mt-0 justify-end">
    {{-- <div class="py-4 pl-6 pr-6 w-64 mb-4 bg-gray-100 
    dark:bg-gray-700 flex-shrink-0 rounded-2xl w-full md:w-1/2">
        <div class="flex flex-row items-center justify-between">
            <span class="font-bold dark:text-gray-200 text-sm">Assigned Staff</span>
            <span class="flex items-center justify-center text-md
                dark:text-gray-200 font-medium h-6 w-6 rounded-full"
            >
                @if (auth()->user()->is_staff())
                <x-ticket.edit-staff-modal>
                    <x-slot name="trigger">
                        <div class="text-blue-500 dark:text-blue-400 hover:text-blue-600 
                        dark:hover:text-blue-500 cursor-pointer">
                            <x-icons.icon name="edit"/>
                        </div>
                    </x-slot>
                </x-ticket.edit-staff-modal>
                @endif

            </span>
        </div>
        @php
            if(request()->ticket->staff->count())
                $num = 12 + request()->ticket->staff->count() + 12; 
            else
                $num = 6;
        @endphp
        <div class="flex flex-col space-y-2 mt-4 h-{{ $num }} overflow-y-auto">
        @foreach(request()->ticket->staff as $staff)
        <div class="flex items-center">
            <img
                class="h-8 w-8 rounded-full"
                src="https://i.pravatar.cc/100?u={{ $staff->id }}"
                alt=""
                title="{{ $staff->name }}"
                loading="lazy"
            /> 
            <p class="ml-3 text-sm dark:text-gray-200 font-medium">{{ $staff->user->name }}</p>
        </div>
        @endforeach 
        </div>
    </div> --}}
    @if (auth()->user()->is_staff())
    <div class="py-4 pl-6 pr-6 w-64 bg-gray-100 
    dark:bg-gray-700 flex-shrink-0 rounded-2xl w-full md:w-1/2">
        <div class="flex flex-col items-center mt-4 w-full px-4 rounded-lg">
            <div class="h-20 w-20 rounded-full overflow-hidden">
                <img src="https://i.pravatar.cc/100?u={{ request()->ticket->author->id }}"
                    alt="Avatar"
                    class="h-full w-full"
                />
            </div>
            <div class="text-sm font-semibold mt-2 dark:text-gray-200">{{ request()->ticket->author->name }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-300">{{ request()->ticket->author->email }}</div>   
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
            <div class="flex flex-col space-y-1 mt-4 -mx-2 h-36 overflow-y-auto">
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
    @endif
</div>