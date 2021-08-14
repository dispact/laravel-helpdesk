@props(['staff'])
<div class="flex -space-x-2 overflow-hidden justify-center">
    @foreach($staff as $staff)
        <img
            class="inline-block h-8 w-8 rounded-full ring-1 ring-white
                dark:ring-gray-700"
            src="https://i.pravatar.cc/100?u={{ $staff->id }}"
            alt=""
            title="{{ $staff->name }}"
            loading="lazy"
        /> 
    @endforeach
</div>