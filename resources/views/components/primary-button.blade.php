<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-beige-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-beige-600 focus:bg-beige-600 active:bg-beige-800 focus:outline-none focus:ring-2 focus:ring-beige-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
