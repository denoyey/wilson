<div class="w-full max-w-md relative z-10">
    <div class="fixed inset-0 flex items-center justify-center z-[-1] pointer-events-none opacity-5">
        <img src="{{ asset('img/logo/logo.webp') }}" alt="Background Logo" class="w-[80vw] max-w-4xl object-contain">
    </div>

    <x-card class="p-8 gsap-card">
        
        <div class="text-center mb-6 gsap-login-item">
            <img src="{{ asset('img/logo/logo.webp') }}" alt="PT Wilson" class="h-16 w-auto mx-auto mb-4 object-contain">
            <p class="mt-2 text-sm font-medium text-gray-500">Sistem Inventory PT Wilson</p>
        </div>

        <form wire:submit="login" class="space-y-5">
            <div class="gsap-login-item">
                <x-label for="username" value="Username" />
                <x-input
                    wire:model="username"
                    id="username"
                    type="text"
                    autocomplete="username"
                    autofocus
                    placeholder="Masukkan username"
                />
                <x-error for="username" />
            </div>

            <div x-data="{ show: false }" class="gsap-login-item">
                <x-label for="password" value="Password" />
                <div class="relative">
                    <x-input
                        wire:model="password"
                        id="password"
                        x-bind:type="show ? 'text' : 'password'"
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="pr-12"
                    />
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                <x-error for="password" />
            </div>

            <div class="flex items-center justify-between gsap-login-item">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        wire:model="remember"
                        id="remember"
                        type="checkbox"
                        class="w-4 h-4 rounded border-gray-300 bg-white text-blue-600 focus:ring-blue-500 focus:ring-offset-0"
                    />
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <x-button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full py-3 gsap-login-item gap-2"
            >
                <svg wire:loading class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove>Masuk</span>
                <span wire:loading>Memproses...</span>
            </x-button>
        </form>
    </x-card>

    <p class="mt-6 text-center text-xs text-gray-500 relative z-10 gsap-login-item">
        &copy; {{ date('Y') }} PT Wilson. All rights reserved.
    </p>


</div>