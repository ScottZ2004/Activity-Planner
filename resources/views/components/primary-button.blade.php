<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-orange rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
