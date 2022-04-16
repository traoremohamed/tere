<?php

use App\Helpers\Menu;

$logo = Menu::get_logo();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BTP | CONNEXION</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="backendnw/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="backendnw/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="backendnw/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <?php if(isset($logo->logo_logo)){?>
        <link rel="shortcut icon" href="{{ asset('/frontend/logo/'. $logo->logo_logo)}}" />
    <?php } ?>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <?php if(isset($logo->logo_logo)){?>
            <img src="{{ asset('/frontend/logo/'. $logo->logo_logo)}}" class="max-h-90px" alt="" />
        <?php } ?>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <!--<p class="login-box-msg">Sign in to start your session</p>-->


            <form class="form" novalidate="novalidate" id="kt_login_signin_form" method="post"
                  action="{{ url('connexion') }}">
                {{ csrf_field() }}

                <p class="login-box-msg">
                    @if ($errors->any())

                <div class="alert alert-custom alert-danger fade show" role="alert">
                    <div class="alert-text">
                        <strong> </strong>   Votre Email ou votre mot de passe est incorrect !
                    </div>
                    <div class="alert-close">
                        <button type="button" class="btn-sx close" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
                @endif

                @if ($message = Session::get('error'))
                <div class="alert alert-custom alert-danger fade show">
                    {{ $message }}
                </div>
                @endif
                </p>

                <div class="input-group mb-3">

                    <input type="text" class="form-control" placeholder="Identifiant" required="required" name="username" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">

                    <input type="password" class="form-control" placeholder="Mot de passe" required="required" placeholder="Password" name="password" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-danger" class="reload" id="reload" style="background-color: #ff8608;border-color: #FF8608;color: #FFFFFF">
                            &#x21bb;
                        </button>
                    </div>
                </div>
                <p><label class="font-size-h6 font-weight-bolder text-dark pt-5">Saisir le mot ci-dessus</label></p>
                <div class="input-group mb-3">
                    <input id="captcha" type="text" autocomplete="off" class="form-control" placeholder="Vérificateur de sécurité" name="captcha">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <input type="submit" id="kt_login_signin_submit" name="connecter"
                               class="btn btn-primary btn-block"
                               value="Se connecter" style="background-color: #ff8608;border-color: #FF8608;color: #FFFFFF">
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!--<div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>-->
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="{{ url('motdepasseoublie') }}">Mot de passe oublié ?</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="backendnw/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="backendnw/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="backendnw/dist/js/adminlte.min.js"></script>

</body>
</html>
