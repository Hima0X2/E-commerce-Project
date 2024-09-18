<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .registration-container {
            max-width: 500px;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .logo-container img {
            max-width: 120px;
            height: auto;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-check-label {
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <x-guest-layout>
        <div class="registration-container bg-white">
            <x-slot name="logo">
                <div class="logo-container">
                    <x-authentication-card-logo />
                </div>
            </x-slot>

            <x-validation-errors class="alert alert-danger mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <x-label for="phone" value="{{ __('Phone') }}" />
                    <x-input id="phone" class="form-control" type="number" name="phone" :value="old('phone')" required autocomplete="username" />
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <x-label for="address" value="{{ __('Address') }}" />
                    <x-input id="address" class="form-control" type="text" name="address" :value="old('address')" required autocomplete="username" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <!-- Terms and Privacy Policy -->
                    <div class="mb-3">
                        <x-label for="terms">
                            <div class="d-flex align-items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <label for="terms" class="form-check-label ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-decoration-none text-primary">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-decoration-none text-primary">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </label>
                            </div>
                        </x-label>
                    </div>
                @endif

                <!-- Actions -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="text-decoration-none" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </x-guest-layout>

    <!-- Bootstrap JS (Optional for enhanced features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
