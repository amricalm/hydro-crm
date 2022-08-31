        <!-- Meta data -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta content="" name="description">
        <meta content="" name="author">
        <meta name="keywords" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>Hydro CRM {{ (!empty($judul) ? ' - '.$judul : '') }}</title>

        <!--Favicon -->
        <link rel="icon" href="{{ asset('assets/images/brand/favicon.ico')}}" type="image/x-icon" />

        <!--Bootstrap css -->
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Style css -->
        <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/css/dark.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

        <!-- Animate css -->
        <link href="{{ asset('assets/css/animated.css')}}" rel="stylesheet" />

        <!--Sidemenu css -->
        <link href="{{ asset('assets/css/sidemenu.css')}}" rel="stylesheet" id="sidemenu-theme">

        <!---Icons css-->
        <link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" />

        <!-- INTERNAL Select2 css -->
        <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

        <!-- Color Skin css -->
        <link id="theme" href="{{ asset('assets/colors/color1.css')}}" rel="stylesheet" type="text/css" />

        <link href="../css/bootstrap-combobox.css" rel="stylesheet">
        <link href="../css/jquery.autocomplete.css" rel="stylesheet">
        <link href="{{ asset('css/app.css')}}" rel="stylesheet" type="text/css" />

        
        @stack('header')
