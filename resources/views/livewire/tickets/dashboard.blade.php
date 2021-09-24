<x-slot name="header">
    @if(request()->user()->is_staff())
        Ticket Dashboard
    @else
        My Tickets
    @endif
</x-slot>

<div class="max-w-7xl sm:px-6 lg:px-8 pb-6">
    <div class="mb-2 md:flex md:flex-inline items-end justify-between">
        <div class="md:flex md:flex-inline w-full md:space-x-2 space-y-2 md:space-y-0">
            @if(request()->user()->is_staff())
            <x-filters.status-dropdown wire:model="status"/> 
            <x-filters.category-dropdown wire:model="category"/>
            <x-filters.building-dropdown wire:model="building"/>
            <x-filters.staff-dropdown wire:model="staff"/>
            @endif
        </div>
        <div class="md:mb-0 md:mt-0 mb-4 mt-4 md:w-1/3">
            <x-forms.search-input 
                wire:model.debounce.500ms="search" 
                placeholder="Search tickets..."
            />
        </div>
    </div>

    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left 
                        text-gray-400 uppercase border-b dark:border-gray-700 
                        bg-gray-50 dark:text-gray-500 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">Client</th>
                        <th class="px-4 py-3 w-1/2">Subject</th>
                        <th class="px-4 py-3 text-center">Staff</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($tickets as $ticket)
                    <tr class="text-gray-700 dark:text-gray-400 cursor-pointer hover:bg-gray-200
                        dark:hover:bg-gray-600" 
                        @if(request()->route()->named('tickets.index'))
                        onclick="window.location='{{ route('tickets.show', $ticket->id) }}';"
                        @else
                        onclick="window.location='{{ route('requests.show', $ticket->id) }}';"
                        @endif>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                {{-- <span class="inline-block w-2 h-2 mr-4 dark:bg-green-400 bg-green-500 rounded-full"></span> --}}
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img
                                        class="object-cover w-full h-full rounded-full"
                                        src="https://i.pravatar.cc/100?u={{ $ticket->author->id ?? '0'}}"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <p class="font-semibold dark:text-gray-200"
                                    >
                                        {{ $ticket->author->name ?? 'Unknown'}}
                                    </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $ticket->building->name ?? ''}}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-3 text-sm dark:text-gray-200">
                            <p class="line-clamp-1">{{ $ticket->title ?? '' }}</p>
                        </td>

                        <td class="px-4 py-3">
                            <x-cards.staff-avatars :staff="$ticket->staff"/>
                        </td>

                        <td class="px-4 py-3 text-xs max-w-sm text-center">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                text-{{ $ticket->status->getStatusColorAttribute($ticket->status->color ?? '9') }}-700 
                                bg-{{ $ticket->status->getStatusColorAttribute($ticket->status->color ?? '9') }}-100 
                                dark:bg-{{ $ticket->status->getStatusColorAttribute($ticket->status->color ?? '9') }}-700 
                                dark:text-{{ $ticket->status->getStatusColorAttribute($ticket->status->color ?? '9') }}-100"
                            >
                                {{ $ticket->status->name ?? '-'}}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm text-center dark:text-gray-200">
                            {{ $ticket->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (!$tickets->count())
            <tr>
                <p class="dark:text-gray-300 text-center mt-4 font-medium
                    text-gray-600">There are currently no tickets.</p>
            </tr>
        @endif
    </div>
    {{ $tickets->links() }}
</div>
