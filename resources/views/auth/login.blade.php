<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        <div>
            <h1 class="text-1xl font-bold">Heb je een account? Log dan hieronder in:</h1>
        </div>
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div>
            <h1 class="text-1xl font-bold">Heb je geen account? klik dan op de 'Ga verder'</h1>
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ms-3">
                {{__('Log in')}}
            </x-primary-button>

            <a href="{{ url()->previous() }}" style="margin-left: 15px;">Ga verder</a>
            

        </div>
    </form>
    
</x-guest-layout>