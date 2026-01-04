<section>
    <header class="mb-3">
        <h2 class="h5 mb-2">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- Re-send verification form --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        {{-- Name --}}
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="form-control @error('name') is-invalid @enderror"
            >

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="form-control @error('email') is-invalid @enderror"
            >

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- Email Verification Notice --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="mb-2">
                        <span class="text-dark">{{ __('Your email address is unverified.') }}</span>
                    </p>

                    <button type="submit" form="send-verification" class="btn btn-link p-0 align-baseline">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-3 mb-0">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-muted ml-3" id="profileSavedMsg">
                    {{ __('Saved.') }}
                </span>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        setTimeout(function () {
                            var el = document.getElementById('profileSavedMsg');
                            if (el) el.style.display = 'none';
                        }, 2000);
                    });
                </script>
            @endif
        </div>
    </form>
</section>
