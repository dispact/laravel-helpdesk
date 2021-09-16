@props(['type' => 'tickets'])
@php 
    $class = "w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 
            bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 
            dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 
            dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 
            focus:bg-white focus:border-purple-300 focus:outline-none 
            focus:shadow-outline-purple form-input"
@endphp
<div class="absolute inset-y-0 flex items-center pl-2">
    <x-icons.icon name="search"/>
</div>
@if ($type == 'tickets')
<form method="GET" @if(auth()->user()->is_staff()) action="{{ route('tickets.index') }}"
    @else action="{{ route('requests.index') }}"@endif>
    <input class="{{ $class }}"
        type="text" name="search"
        placeholder="Search tickets"
        aria-label="Search"
        value="{{ request('search') }}"
    />
</form>
@elseif ($type == 'buildings')
<div x-data="{ search: '' }">
    <input class="{{ $class }}"
        x-model="search"
        type="text"
        placeholder="Search buildings"
        aria-label="Search"
    />
</div>
@elseif ($type == 'categories')
<form method="GET" action="{{ route('categories.index') }}">
    <input class="{{ $class }}"
        type="text" name="search"
        placeholder="Search categories"
        aria-label="Search"
        value="{{ request('search') }}"
    />
</form>
@elseif ($type == 'staff')
<form method="GET" action="{{ route('staff.index') }}">
    <input 
        
        class="{{ $class }}"
        type="text" name="search"
        placeholder="Search staff"
        aria-label="Search"
        value="{{ request('search') }}"
    />
</form>
@elseif ($type == 'users')
<form method="GET" action="{{ route('users.index') }}">
    <input class="{{ $class }}"
        type="text" name="search"
        placeholder="Search users"
        aria-label="Search"
        value="{{ request('search') }}"
    />
</form>
@elseif ($type == 'requests')
<form method="GET" action="{{ route('requests.index') }}">
    <input class="{{ $class }}"
        type="text" name="search"
        placeholder="Search tickets"
        aria-label="Search"
        value="{{ request('search') }}"
    />
</form>
@elseif ($type == 'status')
<form method="GET" action="{{ route('status.index') }}">
    <input class="{{ $class }}"
        type="text" name="search"
        placeholder="Search statuses"
        aria-label="Search"
        value="{{ request('search') }}"
    />
</form>
@endif