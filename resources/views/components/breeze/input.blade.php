@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring-1 focus:ring-blue-200 
        focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-400
        dark:focus:ring-blue-300'
]) !!}>
