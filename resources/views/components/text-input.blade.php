@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-beige-300 focus:border-beige-500 focus:ring-beige-500 rounded-md shadow-sm']) }}>
