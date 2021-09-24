@props(['createModal' => false, 'editModal' => false])
<div class="fixed z-50 inset-0 overflow-y-auto m-auto" aria-labelledby="modal-title" 
   role="dialog" aria-modal="true"
   x-data="{ 
      show: @entangle($attributes->wire('model')).defer,
      emitEvent: @entangle($attributes->wire('model')).defer
   }"
   x-show="show" 
   x-cloak 
>
   <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-40 transition-opacity
         dark:bg-gray-800 dark:bg-opacity-80" aria-hidden="true" x-show="true"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
      ></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">
         &#8203;
      </span>

      <form wire:submit.prevent="emitEvent"
         class="inline-block align-bottom bg-white dark:bg-gray-700 rounded-lg text-left 
            overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle 
            sm:max-w-lg sm:w-full ring-gray-500 ring-2 ring-opacity-10 m-auto"
         x-show="show" 
         @keydown.escape.window="show = false"
         @click.away="show = false"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      >
         <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
               <div class="mx-auto flex-shrink-0 flex items-center 
                  justify-center h-12 w-12 rounded-full
                  sm:mx-0 sm:h-10 sm:w-10 
                  @if($createModal) bg-green-100 dark:bg-green-200 text-green-500 dark:text-green-600 
                  @elseif($editModal) bg-orange-100 dark:bg-orange-200 text-orange-500 dark:text-orange-600 
                  @else bg-blue-100 dark:bg-blue-200 text-blue-500 dark:text-blue-600  @endif"
               >
                  {{ $icon }}
               </div>
               <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                  <h3 class="text-lg leading-6 font-medium text-gray-900
                     dark:text-gray-200 mt-2"
                  >
                     {{ $header }}
                  </h3>
                  <div class="space-y-4 mt-4 w-full" x-ref="form">
                     {{ $fields }}
                  </div>
               </div>
            </div>
         </div>
         <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button class="w-full inline-flex justify-center 
               rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 
               text-base font-medium text-white hover:bg-blue-700 focus:outline-none 
               focus:ring-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
               type="submit"
            >
               {{ $buttonText }}
            </button>
            <button class="mt-3 w-full inline-flex justify-center rounded-md border 
               border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white 
               dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 
               hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 
               focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
               wire:click="show"
            >
               Cancel
            </button>
         </div>
      </form>
   </div>
</div>  