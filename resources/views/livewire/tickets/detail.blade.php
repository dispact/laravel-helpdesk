<x-slot name="header">
	<div class="flex items-center">

		@if(auth()->user()->is_staff())
		<x-buttons.back link="{{ route('tickets.index') }}"/>
		@else
		<x-buttons.back link="{{ route('requests.index') }}"/>
		@endif

		<span class="ml-6">{{ $ticket->title }}</span>
	</div>
</x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6 ml-3 mr-3 md:mr-0">

	@if(request()->user()->is_staff())
	<div class="flex items-end mb-2">
		<div class="flex space-x-2">
			<x-filters.status-dropdown wire:model="status"/>
			<x-filters.category-dropdown wire:model="category"/>
			<x-filters.building-dropdown wire:model="building"/>
		</div>

		<label class="block text-xs text-center ml-4">
			<span class="text-gray-500 dark:text-gray-400 mb-4">
				Staff
			</span>
			<div class="flex -space-x-2 items-center justify-center mt-1.5">
				@foreach($ticket->staff as $staff)
				<img class="inline-block h-8 w-8 rounded-full 
					ring-2 ring-gray-200 dark:ring-gray-600" 
					src="https://i.pravatar.cc/100?u={{ $staff->user->id }}" alt="{{ $staff->user->name }}">
				@endforeach
			</div>
		</label>		
	</div>
	@endif
	
	@livewire('tickets.chat', ['ticketId' => $ticket->id])

</div>
