<section>
    <header class="mb-3">
        <h2 class="h5 mb-2">
            {{ __('Update Password') }}
        </h2>

        <p class="text-muted mb-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div class="form-group">
            <label for="update_password_current_password">{{ __('Current Password') }}</label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="form-control @if($errors->updatePassword->get('current_password')) is-invalid @endif"
            >

            @if($errors->updatePassword->get('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="update_password_password">{{ __('New Password') }}</label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="form-control @if($errors->updatePassword->get('password')) is-invalid @endif"
            >

            @if($errors->updatePassword->get('password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="form-control @if($errors->updatePassword->get('password_confirmation')) is-invalid @endif"
            >

            @if($errors->updatePassword->get('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-muted ml-3" id="passwordSavedMsg">
                    {{ __('Saved.') }}
                </span>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        setTimeout(function () {
                            var el = document.getElementById('passwordSavedMsg');
                            if (el) el.style.display = 'none';
                        }, 2000);
                    });
                </script>
            @endif
        </div>
    </form>
</section>
