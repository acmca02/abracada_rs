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
                <div class="login-txt ms-0 ms-lg-5">
                    <h3>{{get_phrase('S\'inscrire')}}</h3>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group form-name">
                            <label for="#">{{get_phrase('Nom complet')}}</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="{{get_phrase('Votre Nom complet')}}">
                        </div>
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        <div class="form-group form-email">
                            <label for="#">{{get_phrase('Email')}}</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="{{get_phrase('Entrez votre adresse e-mail')}}">
                        </div>
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        <div class="form-group form-pass">
                            <label for="#">{{get_phrase('mot de passe')}}</label>
                            <input type="password" name="password" placeholder="{{get_phrase('Votre mot de passe')}}">
                        </div>

                        <div class="form-group form-pass">
                            <label for="#">{{get_phrase('Confirmez le mot de passe')}}</label>
                            <input type="password" name="password_confirmation" placeholder="{{get_phrase('Confirmez le mot de passe')}}">
                        </div>
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        <input type="hidden" name="timezone" id="timezone" value="">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="check1" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">{{get_phrase('J\'accepte les')}} <a href="{{ route('term.view') }}">{{get_phrase('Conditions Générales')}}</a></label>
                        </div>

                        <input class="my-3" type="submit" name="submit" id="submit" value="S'inscrire">
                    </form>

                </div>
            </div>
        </div>

    </div> <!-- container end -->
</main>
<!-- Main End -->

<style>
    /* Style par défaut (bleu clair) */
    input[type="submit"] {
        background: #0D3475;  /* Bleu clair */
        padding: 10px 32px;
        color: #fff;
        border: 1px solid #0D3475;
        cursor: pointer;
    }

    /* Survol (devient orange) */
    input[type="submit"]:hover {
        background: #FFAA01;  /* Orange */
        color: #0D3475 !important;;
        border: 1px solid #FFAA01;
    }

    /* Lorsque l'élément est cliqué (focus) */
    input[type="submit"]:active {
        background: #FFAA01;  /* Orange */
        color:#0D3475 !important;;
        border: 1px solid #FFAA01;
    }
</style>

@include('auth.layout.footer')
