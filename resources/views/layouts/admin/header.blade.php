<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Labtek</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="{{ asset('assets/images/labtek_wo_text.png') }}" type="image/png">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/summernote/summernote.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/sweetalert2.min.css') }}">


    <!-- jQuery -->
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    
    <!-- Bootstrap JS -->
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>



    <!-- Fonts and icons -->
    <script src="{{asset('kaiadmin-lite-1.2.0/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('kaiadmin-lite-1.2.0/assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('kaiadmin-lite-1.2.0/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('kaiadmin-lite-1.2.0/assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('kaiadmin-lite-1.2.0/assets/css/kaiadmin.min.css')}}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('kaiadmin-lite-1.2.0/assets/css/demo.css')}}" />
  </head>
  <body>
    <div class="wrapper">