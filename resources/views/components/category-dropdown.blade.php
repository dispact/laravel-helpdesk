<x-dropdown>
    
    <x-slot name="label">
        Category
    </x-slot>

    @php
        if(empty(request()->except('category')))
            $link = '?' . http_build_query(request()->except('category'));
        else 
            $link = '?' . http_build_query(request()->except('category')) . '&';
    @endphp

    <x-slot name="title">
        {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'All' }}
    </x-slot>

    <x-dropdown-item href="{{ $link }}" 
        :active="request('category') === null"
    >
        All
    </x-dropdown-item>

    @foreach($categories as $category)
        <x-dropdown-item 
            href="{{ $link }}category={{ $category->id }}"
            :active="request('category') == $category->id"
        >
            {{ ucwords($category->name) }}
        </x-dropdown-item>
    @endforeach

</x-dropdown>