<x-app-layout>
    <x-slot name="header">
        {{ __('Tickets') }}
    </x-slot>

    <div class="ml-3 md:ml-6">
        <x-filters.status-dropdown/> 
        <x-filters.category-dropdown/>
        <x-filters.staff-dropdown/>
    </div>
    
    <div class="max-w-7xl sm:px-6 lg:px-8 pb-6">
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
                            onclick="window.location='{{ route('tickets.show', $ticket->id) }}';">
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
</x-app-layout>

<script>
jQuery(document).ready(function($) {
	$(".ticket-row").click(function() {
		window.location = $(this).data('href');
	})
})
</script>