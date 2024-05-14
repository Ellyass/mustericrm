<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Müşteri CRM</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">

    <!-- AdminLTE Theme -->
    <link rel="stylesheet" href="/backend/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/semantic.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href="/backend/dist/css/skins/skin-blue.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/backend/custom/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">


    <!-- Logo -->
    <link rel="icon" href="/public/storage/images/logo/logo.png" type="image/x-icon">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="/backend/dist/js/adminlte.min.js"></script>

    <!-- Moment.js -->
    <script src="/backend/bower_components/moment/min/moment.min.js"></script>

    <!-- Date Range Picker -->
    <script src="/backend/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Date Picker -->
    <script src="/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/backend/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.tr.min.js"></script>

    <!-- InputMask -->
    <script src="/backend/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/backend/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/backend/plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>

    <!-- FastClick -->
    <script src="/backend/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- FullCalendar -->
    <script src="/backend/bower_components/fullcalendar-6.1.11/dist/index.global.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SweetAlert2 -->
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
        <a href="{{route('default.Index')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>BY</b>S</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>ByDENT</b> Satış</span>
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
                            <span class="hidden-xs"><!--Buraya Auth user gelicek-->{{ Auth::user()->name }}</span>
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
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <a href="{{ route('user.Edit', Auth::user()->id) }}"
                                           class="btn btn-info btn-flat">
                                            <i class="fa fa-user-circle-o"></i> Profili Düzenle
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('default.Logout') }}" class="btn btn-danger btn-flat">
                                            <i class="fa fa-sign-out"></i> Çıkış Yap
                                        </a>
                                    </div>
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
                    <img class="img-circle" src="/storage/images/logo/logo.png" alt="User Image">
                </div>
                <div class="pull-left info">
                    <!--Buraya Auth user gelicek-->
                    <p> {{ Auth::user()->name }}</p>
                    <i class="fa fa-circle text-success"></i>
                    <small>@if( Auth::user()->role == 'admin' )
                            Yönetici
                        @elseif( Auth::user()->role == 'user' )
                            Satışçı
                        @endif</small>
                    <!-- Status -->
                </div>
            </div>


            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header" style="text-align: center">Menüler</li>
                <!-- Optionally, you can add icons to the links -->

                <li class="active"><a href="{{route('default.Index')}}"><i class="fa fa-home"></i>
                        <span>Anasayfa</span></a></li>
                @if( Auth::user()->role == 'admin' )
                    <li class="treeview">
                        <a href="#"><i class="fa fa-briefcase"></i> <span>Yönetici</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('user.Index') }}"><i class="fa fa-user-circle-o"></i>
                                    <span>Kullanıcılar</span></a></li>

                            <li><a href="{{ route('authorization.Index') }}"><i
                                        class="fa fa-arrow-circle-o-right"></i>
                                    <span>Yetkilendirme</span></a></li>
                        </ul>
                    </li>
                @endif
                <li><a href="{{route('customer.Index')}}"><i class="fa fa-users"></i>
                        <span>Müşteriler</span></a>
                </li>
                <li><a href="{{route('sales.Index')}}"><i class="fa fa-money"></i>
                        <span>Satış Yapılan Müşteriler</span></a>
                </li>
                <li><a href="{{route('cancel.Index')}}"><i class="fa fa-ban"></i>
                        <span>İptal Edilen Müşteriler</span></a>
                </li>
                <li><a href="{{route('meet.Index')}}"><i class="fa fa-calendar"></i>
                        <span>Randevular</span></a>
                </li>
                <li><a href="{{route('product.Index')}}"><i class="fa fa-barcode"></i>
                        <span>Ürünler</span></a></li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        @yield('content')
        <!-- Main content -->
        <section class="content container-fluid">

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

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
    </aside>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@if(session()->has('success'))
    <script>alertify.success('{{session('success')}}')</script>
@endif
@if(session()->has('error'))
    <script>alertify.error('{{session('error')}}')</script>
@endif

@foreach($errors->all() as $error)
    <script>
        alertify.error('{{$error}}');
    </script>
@endforeach
</body>
</html>

