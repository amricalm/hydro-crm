<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Hydro" name="description">
    <meta content="Andhana Web & Software Developer" name="author">
    <meta name="keywords" content="Hydro">
    <!-- Title -->
    <title>Hydro CRM - Login</title>
    <!--Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand/favicon.ico')}}" type="image/x-icon" />
    <!--Bootstrap css -->
    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dark.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skin-modes.css')}}" rel="stylesheet" />
    <!-- Animate css -->
    <link href="{{ asset('assets/css/animated.css')}}" rel="stylesheet" />
    <!---Icons css-->
    <link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" />
    <!-- Color Skin css -->
    <link id="theme" href="{{ asset('assets/colors/color1.css')}}" rel="stylesheet" type="text/css" />
</head>

<body class="register-2">
    <div class="page">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="text-center mb-5">
                                    <img src="{{ asset('assets/images/brand/logo.png')}}" style="height: 8rem" class="header-brand-img desktop-lgo" alt="hydro logo">
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery js-->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap5 js-->
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--Othercharts js-->
    <script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>
    <!-- Circle-progress js-->
    <script src="{{ asset('assets/js/circle-progress.min.js')}}"></script>
    <!-- Jquery-rating js-->
    <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
    <!-- Show Password -->
    <script src="{{ asset('assets/js/bootstrap-show-password.min.js')}}"></script>
    <!-- Custom js-->
    <script src="{{ asset('assets/js/custom.js')}}"></script>
    <script type="text/javascript">
        var msg = "{{Session::get('alert ')}}";
        var exist = "{{Session::has('alert')}}";
        if (exist) {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: msg
            })
        }
        $(document).ready(function() {
            $('#username').focus();
        });

        function submited() {
            $('#btnSubmit').removeClass('btn-primary');
            $('#btnSubmit').addClass('btn-warning');
            $('#btnSubmit').html("<i class='fa fa-spinner fa-spin'></i> Sedang proses ...");
            return true;
        }
    </script>
</body>

</html>
