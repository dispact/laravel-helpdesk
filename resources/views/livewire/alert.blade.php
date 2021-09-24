<div x-data="
	{ 
		show: @entangle('showAlert'), 
		type: @entangle('type'),
		timer: null,

		beginTimeout() {
			this.show = true;
			this.timer = setTimeout(() => this.show = false, 2000);
		},

		restartTimeout() {
			clearTimeout(this.timer);
			this.beginTimeout();
		}

	}" 
	@alert-timeout.window="restartTimeout();"
	x-cloak
>
	<div class="fixed inset-0 p-4 rounded-md z-50 max-h-14 max-w-xl ml-auto mr-auto mt-1"
		:class="type == 'success' ? 'bg-green-200 dark:bg-green-500' : 'bg-red-200 dark:bg-red-500'"
		x-show="show"
		x-transition:enter="ease-out duration-300"
		x-transition:enter-start="opacity-0 transform -translate-y-24"
		x-transition:enter-end="opacity-100"
		x-transition:leave="ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0 transform -translate-y-24"
	>
		<div class="flex">
			<div class="flex-shrink-0">
				<x-icons.icon name="check-circle"/>
			</div>
			<div class="ml-3">
				<p 
					class="text-sm font-medium"
					:class="type == 'success' ? 'text-green-800 dark:text-green-100' : 'text-red-800 dark:text-red-100'"
				>
					{{ $message }}
				</p>
			</div>
			<div class="ml-auto pl-3">
				<div class="-mx-1.5 -my-1.5">
					<button @click="show = false"
						type="button" 
						class="inline-flex rounded-md p-1.5"
						:class="type == 'success' ?
							'text-green-500 hover:text-green-700 dark:text-green-200 dark:hover:text-green-700' :
							'text-red-500 hover:text-red-700 dark:text-red-200 dark:hover:text-red-700'"
					>
						<span class="sr-only">Dismiss</span>
						<x-icons.icon name="X"/>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>