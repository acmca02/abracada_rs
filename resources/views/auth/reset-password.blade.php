@include('auth.layout.header')

<!-- Main Start -->
<main class="main my-4 p-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="login-img">
                    <img class="img-fluid" src="{{ asset('assets/frontend/images/login.png') }} " alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-4 text-sm text-gray-600">
                    {{ get_phrase('Reset Password Now') }}
                </div>
        
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
        
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="get_phrase('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                    </div>
        
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="get_phrase('mot de passe')" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    </div>
        
                    <!-- Confirmez le mot de passe -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="get_phrase('Confirmez le mot de passe')" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>
        
                    <div class="flex items-center justify-end mt-4">
                        <button class="btn btn-warning my-3 py-2 rounded-10px p-10px custom-btn">
                            {{ get_phrase('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- container end -->
</main>
<!-- Main End -->

@include('auth.layout.footer')

<style>
    /* Custom Button Styles */
    .custom-btn {
        background-color: #0D3475 !important;
        color: #ffffff !important;
        border-color: #d97312 !important;
    }

    /* Ensure the button stays orange even when clicked or focused */
    .custom-btn:hover,
    .custom-btn:focus,
    .custom-btn:active {
        background-color: #FFAA01 !important;
        color: #0D3475 !important;
        border-color: #d97312 !important;
        box-shadow: none !important;
    }
</style>
