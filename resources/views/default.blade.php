<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ByDENT | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Theme style -->
    <link rel="stylesheet" href="/backend/dist/css/AdminLTE.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="/backend/plugins/iCheck/square/blue.css">

    <!-- Logo -->
    <link rel="icon" href="/storage/images/logo/logo.png" type="image/x-icon">

    <!-- HTML5 Shiv -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <!-- Respond.js -->
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <!-- jQuery 3 -->
    <script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- iCheck -->
    <script src="/backend/plugins/iCheck/icheck.min.js"></script>

    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>


    <style type="text/css">

        .login-logo a {
            color: lightslategrey;
        }

        .login-page {
            background: url("/storage/images/login/default.jpg") no-repeat center center fixed;
            background-size: auto;
            -webkit-background-size: auto;
            -moz-background-size: auto;
            -o-background-size: auto;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-buttons {
            max-width: 400px;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-warning,
        .btn-success {
            padding: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-warning i,
        .btn-success i {
            margin-right: 10px;
        }

        .btn-warning:hover,
        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('default.login.Login') }}"><b>ByDENT</b> CRM</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body d-flex justify-content-between">
            <a href="{{ route('default.Login') }}" class="btn btn-success" style="width: 48%;">
                <i class="fa fa-dollar"></i> Satış
            </a>
            <a href="{{ route('onarim.default.Login') }}" class="btn btn-warning" style="width: 48%;">
                <i class="fa fa-cogs"></i> Onarım
            </a>
        </div>
    </div>
</div>
</body>

@if(session()->has('success'))
    <script>alertify.success('{{ session('success') }}')</script>
@endif
@if(session()->has('error'))
    <script>alertify.error('{{ session('error') }}')</script>
@endif

@foreach($errors->all() as $error)
    <script>
        alertify.error('{{$error}}');
    </script>
@endforeach

</html>
