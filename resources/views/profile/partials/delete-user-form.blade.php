<section class="mb-4">
    <header class="mb-3">
        <h2 class="h5 mb-2">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmUserDeletionModal">
        {{ __('Delete Account') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" role="dialog" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="form-group mb-0">
                            <label for="delete_password" class="sr-only">{{ __('Password') }}</label>

                            <input
                                id="delete_password"
                                name="password"
                                type="password"
                                class="form-control @if($errors->userDeletion->get('password')) is-invalid @endif"
                                placeholder="{{ __('Password') }}"
                                autocomplete="current-password"
                            >

                            @if($errors->userDeletion->get('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete Account') }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

