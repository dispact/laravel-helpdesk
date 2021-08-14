<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">

            @if(auth()->user()->is_staff())
            <x-buttons.back link="{{ route('tickets.index') }}"/>
            @else
            <x-buttons.back link="{{ route('requests.index') }}"/>
            @endif

            <span class="ml-6">{{ $ticket->title }}</span>

            @if(auth()->user()->is_staff())
            <x-ticket.edit-ticket-modal>
                <x-slot name="trigger">
                    <div class="text-orange-500 dark:text-orange-400 hover:text-orange-600 
                        dark:hover:text-orange-500 cursor-pointer">
                        <x-icons.icon name="edit"/>
                    </div>
                </x-slot>
            </x-ticket.edit-ticket-modal>
            @endif

        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6 ml-3 ">
        
        <div class="grid gap-4 grid-cols-4 md:grid-cols-8">
            <x-cards.ticket-stat name="Status" color="{{ $ticket->status->color }}">
                {{ $ticket->status->name }}
            </x-cards.ticket-stat>
            <x-cards.ticket-stat name="Category">{{ $ticket->category->name }}</x-cards.ticket-stat>
            <x-cards.ticket-stat name="Building">{{ $ticket->building->name }}</x-cards.ticket-stat>
        </div>
       
        <x-ticket.chat/>

    </div>

</x-app-layout>