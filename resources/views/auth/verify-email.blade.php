@include('auth.layout.header')

    <style type="text/css">
        .font-family-serif {
            font-family: serif;
        }
    </style>
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
                    <div class="login-txt ms-0 ms-lg-5 text-center fs-5 w-100 mb-20 fw-bold font-family-serif">
                        {{ get_phrase('Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ?') }}
                        <br><br>
                        👉 {{ get_phrase('Pensez à vérifier également votre dossier de spams ou courriers indésirables.') }}
                        <br><br>
                        {{ get_phrase('Si vous n\'avez pas reçu l\'e-mail, nous serons heureux de vous en envoyer un autre.') }}
                    </div>
                    

                    <div class="ms-0 ms-lg-5 my-5">

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success text-center">
                                {{ get_phrase('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de votre inscription.') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div>
                                <button type="submit" class="btn btn-custom w-100 p-10px rounded-10px">{{ get_phrase('Renvoyer l\'email de vérification') }}</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-custom w-100 my-3 p-10px rounded-10px">
                                {{ get_phrase('Se déconnecter') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- container end -->
    </main>
    <!-- Main End -->

    <style>
        .btn-custom {
            background: #0D3475; 
            padding: 10px 32px;
            color: #fff;
            border: 1px solid #0D3475;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
    
        /* Survol (devient orange) */
        .btn-custom:hover {
            background: #FFAA01;  /* Orange */
            color: #0D3475;
            border: 1px solid #FFAA01;
        }
    
        /* Lorsque l'élément est cliqué (focus) */
        .btn-custom:active {
            background: #FFAA01;  /* Orange */
            color: #0D3475;
            border: 1px solid #FFAA01;
        }
    </style>

@include('auth.layout.footer')
