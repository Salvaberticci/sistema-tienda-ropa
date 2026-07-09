@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2.5 rounded-xl text-start text-sm font-medium text-beige-700 bg-beige-100 border-l-4 border-beige-500 transition-all duration-200'
            : 'block w-full ps-3 pe-4 py-2.5 rounded-xl text-start text-sm font-medium text-beige-600 hover:text-beige-800 hover:bg-beige-50 border-l-4 border-transparent transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
