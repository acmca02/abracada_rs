@include('auth.layout.header')

<!-- Main Start -->
<main class="main my-4 p-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="login-img">
                    <img class="img-fluid" src="{{ asset('assets/frontend/images/login.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-txt ms-s ms-lg-5">
                    <h3>{{ get_phrase('Obtenir le lien de réinitialisation du mot de passe')}}</h3>
                    <div class="mb-4 text-sm text-gray-600">
                        {{ get_phrase('Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
                    </div>
            
                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-warning" style="background-color: #FFAA01 !important; color: #0D3475 !important; border-color: #d97312 !important;">
                            <x-auth-session-status :status="session('status')" />
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
            
                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="get_phrase('Email')" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            <!-- Submit button -->
                            <input class="btn btn-warning my-3 py-2 rounded-10px p-10px custom-btn" 
                                   type="submit" 
                                   value="{{ get_phrase('Lien de réinitialisation du mot de passe par e-mail') }}">

                            <!-- Back button -->
                            <a class="btn btn-warning my-3 py-2 w-100 rounded-10px p-10px custom-btn" 
                               href="{{ route('login') }}">
                               {{ get_phrase('Retour') }}
                            </a>
                        </div>
                    </form>
                </div>
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
        border-color: #0D3475 !important;
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
