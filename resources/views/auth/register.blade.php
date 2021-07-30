
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    @yield('extra-meta')
    <title>🛒 AGRISTORE</title>

    @yield('extra-script')

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/blog/">

    

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <!-- Ecommerce App CSS -->
    <link rel="stylesheet" href="{{ asset('css/ecommerce.css') }}">

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card " style="background-color: white; width:900px; height:680px; margin-top: 80px">
                <div class="row d-flex justify-content-between">
                    <div class="col-6" style="">
                        <img src="{{ asset('storage/login.jpg') }}" alt=""" srcset="" style="height:678px; width:800px; ">
                    </div>
                    <div class="col-6 justify-content-center" style="background-color:white; padding-left:30px; padding-right:30px">
                        <div class="col-12 text-center">
                            <a class="blog-header-logo text-dark" href="{{ route('products.index') }}">
                              <img src="{{ asset('storage/agristore_logo.jpeg') }}" alt=""" srcset="" style="width:200px; height;200px">
                            </a>
                          </div>
                        <form method="POST" action="{{ route('register') }}" style="justify-content:center">
                            @csrf
                            <div class=" form-group">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                                
                            </div>
                            <div class="col-md-12">
                                <input id="name" type="text" placeholder="Nom" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" >
                    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class=" form-group">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                
                            </div>
                            <div class="col-md-12">
                                <input id="email" placeholder="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class=" form-group">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                                
                            </div>
                            <div class="col-md-12">
                                <input id="password" placeholder="***********"type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class=" form-group">
                                <label for="password-confirm" class="col-md-8 col-form-label text-md-right">{{ __('Confirmer Mot de passe') }}</label>
                                
                            </div>
                            <div class="col-md-12">
                                <input id="password-confirm" placeholder="***********" type="password"  class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 my-5">
                                    <button type="submit" class="btn btn-primary form-control" style="background-color: #44983a; border:none">
                                        {{ __('S\'inscrire') }}
                                    </button>
                                <div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <p class="nav-link text-dark">Vous avez déjà un compte? </p>
                                <a class="nav-link" href="{{ route('login') }}" style="margin-left: -28px">Connectez-vous</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>