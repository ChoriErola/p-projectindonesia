
<div class="card bg-gray-800 text-white" style="border-radius: 1rem;">
    <div class="card-body p-5">
        <a
            href="/"
            class="position-absolute top-0 start-0 m-3 text-white fs-4"
            title="Kembali ke Dashboard"
        >
            <i class="bi bi-arrow-left"></i>
        </a>
        <!-- Session Status -->
        <x-auth-session-status
            class="mb-4 text-center"
            :status="session('status')"
        />

        <form wire:submit="login">
            <div class="mb-md-4 mt-md-2 pb-3 text-center">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-4">
                    Silahkan masukkan email dan password
                </p>
            </div>
            <!-- Email -->
            <div class="form-outline form-white mb-4">
                <x-input-label
                    for="email"
                    :value="__('Masukkan Email')"
                    class="text-white"
                />
                <x-text-input
                    wire:model.live="form.email"
                    id="email"
                    type="email"
                    class="form-control form-control-lg"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error
                    :messages="$errors->get('form.email')"
                    class="mt-2 text-danger"
                />
            </div>
            <!-- Password -->
            <div class="form-outline form-white mb-4">
                <x-input-label
                    for="password"
                    :value="__('Password')"
                    class="text-white"
                />
                <x-text-input
                    wire:model.live="form.password"
                    id="password"
                    type="password"
                    class="form-control form-control-lg"
                    required
                    autocomplete="current-password"
                />
                <x-input-error
                    :messages="$errors->get('form.password')"
                    class="mt-2 text-danger"
                />
            </div>
            <!-- Remember -->
            <div class="form-check mb-4">
                <input
                    wire:model="form.remember"
                    class="form-check-input"
                    type="checkbox"
                    id="remember"
                >
                <label class="form-check-label text-white" for="remember">
                    {{ __('Ingatkan Saya') }}
                </label>
            </div>
            <!-- Submit -->
            <div class="d-grid mb-4 bg-dark rounded">
                <button
                    type="submit"
                    class="btn btn-outline-light btn-lg"
                    wire:loading.attr="disabled"
                >
                    {{ __('Log in') }}
                </button>
            </div>
            <!-- Links -->
            <div class="d-flex justify-content-between">
                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-white"
                    >
                        {{ __('Lupa Kata Sandi?') }}
                    </a>
                @endif
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="text-white fw-bold"
                        wire:navigate
                    >
                        {{ __('Belum Registrasi?') }}
                    </a>
                @endif
            </div>
        </form>

    </div>
</div>