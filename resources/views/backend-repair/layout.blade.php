<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Onarım | CRM</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons CSS -->
    <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="/backend/dist/css/AdminLTE.min.css">

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/alertify.min.css">

    <!-- AdminLTE Blue Skin CSS -->
    <link rel="stylesheet" href="/backend/dist/css/skins/skin-blue.min.css">

    <!-- Google Fonts CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Logo -->
    <link rel="icon" href="/storage/images/logo/logo.png" type="image/x-icon">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


    <!-- jQuery -->
    <script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- AdminLTE App JS -->
    <script src="/backend/dist/js/adminlte.min.js"></script>

    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>

    <!-- InputMask -->
    <script src="/backend/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/backend/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/backend/plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>BY</b>D</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>ByDENT </b> Onarım</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/storage/images/users/{{ Auth::user()->user_file }}" class="user-image"
                                 alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="/storage/images/users/{{ Auth::user()->user_file }}" class="img-circle"
                                     alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-primary btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('onarim.default.Logout') }}" class="btn btn-danger btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/storage/images/logo/logo.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    @if( Auth::user()->role == 'admin' )
                       <small> <i class="fa fa-circle text-success"></i>Yönetici</small>
                    @elseif(Auth::user()->role == 'repair')
                       <small> <i class="fa fa-circle text-success"></i>Onarım</small>
                    @endif
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Menuler</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="{{ route('onarim.default.Index') }}"><i class="fa fa-home"></i> <span>Anasayfa</span></a>
                </li>
                @if( Auth::user()->role == 'admin' )
                <li><a href="{{ route('onarim.user.Index') }}"><i class="fa fa-user-circle-o"></i>
                        <span>Kullanıcılar</span></a></li>
                @endif()

                <li><a href="{{ route('onarim.repair.Index') }}"><i class="fa fa-users"></i> <span>Müşteriler</span></a></li>
                <li><a href="{{ route('onarim.today.Index') }}"><i class="fa fa-phone"></i> <span>Bugün Aranacaklar</span></a></li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content container-fluid">
            @yield('content')
            <!--------------------------
              | Your Page Content Here |
              -------------------------->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs" style="visibility: hidden">
            Elyesa Aydemir / aydemirelyesa86@gmail.com
        </div>
        <!-- Default to the left -->
        <strong> <a href="https://www.bydentgocukonarim.com/">ByDENT</a> &copy; 2023</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
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
</body>
</html>
