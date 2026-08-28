<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 disabled:opacity-60 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
