<div class="py-4 text-gray-500 dark:text-gray-400">
    <a
        class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
        href="#"
    >
        Helpdesk
    </a>
    <ul class="mt-6">
        @if (auth()->user()->is_staff())
            <x-nav.side-nav-link title="Tickets" icon="ticket" 
                active="{{ request()->routeIs('tickets.index') }}"
                link="{{ route('tickets.index') }}"
            />
            <x-nav.side-nav-link title="Inventory" icon="desktop-computer" 
                active="{{ request()->routeIs('devices.index') }}"
                link="{{ route('devices.index') }}"
            />
            <x-nav.management/>
        @else
        <x-nav.side-nav-link title="My Tickets" icon="ticket" 
            active="{{ request()->routeIs('requests.index') }}"
            link="{{ route('requests.index') }}"
        />
        @endif
    </ul>
    <div class="px-6 my-6">
        <a href="{{ route('requests.create') }}"
            class="flex items-center justify-between px-4 py-2 
                text-sm font-medium leading-5 text-white transition-colors 
                duration-150 bg-blue-600 border border-transparent rounded-lg 
                active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
        >
            Create Ticket
            <span class="ml-2" aria-hidden="true">+</span>
        </a>
    </div>
</div>