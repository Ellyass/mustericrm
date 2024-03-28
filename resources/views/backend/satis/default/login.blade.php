<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Satış | Giriş Yap</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/backend/plugins/iCheck/square/blue.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/backend/dist/css/AdminLTE.min.css">
    <!--Logo-->
    <link rel="icon" href="/storage/images/logo/logo.png" type="image/x-icon">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style type="text/css">
        .login-page {
            background: url("/storage/images/login/satis.jpg") no-repeat center center fixed;
            background-size: auto;
            -webkit-background-size: auto;
            -moz-background-size: auto;
            -o-background-size: auto;
        }
        body {
            overflow: hidden;
            background-color: transparent !important;
        }
        .login-box {
            background-color: rgba(255, 255, 255, 0.5);
            border: 1px solid #d2d6de;
            border-radius: 5px;
        }
        .login-box-body {
            background-color: rgba(255, 255, 255, 0);
        }
        .alert {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-box-body">
        <div class="login-logo">
            <a href="{{ route('default.Login') }}"><b>Satış</b> CRM</a>
        </div>
        <strong><p class="login-box-msg">Oturumunuzu başlatmak için giriş yapın</p></strong>

        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @elseif(Session::has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        <form action="{{ route('default.Authenticate') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox">Beni Hatırla
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-success btn-block">
                        Giriş Yap <i class="fa fa-sign-in"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/backend/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    });
</script>
</body>
</html>
