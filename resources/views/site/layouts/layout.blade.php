<!DOCTYPE html>
<html lang="en">
        <Head>
            <meta charset="utf-8" />
            <meta content="width=device-width, initial-scale=1.0" name="viewport" />

            <title>Mentor Bootstrap Template - Index</title>
            <meta content="" name="description" />
            <meta content="" name="keywords" />

            <!-- Favicons -->
            <link href="/apple-touch-icon.png" rel="apple-touch-icon" />

            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

            <!-- styles/vendor CSS Files -->
            <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
            <link href="{{ asset('/vendor/icofont/icofont.min.css')}}" rel="stylesheet" />
            <link href="{{ asset('/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet" />
            <link href="{{ asset('/vendor/remixicon/remixicon.css')}}" rel="stylesheet" />
            <link href="{{ asset('/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet"/>
            <link href="{{ asset('/vendor/animate.css/animate.min.css')}}" rel="stylesheet" />
            <link href="{{ asset('/vendor/aos/aos.css')}}" rel="stylesheet" />
            <link
            rel="stylesheet"
            type="text/css"
            charset="UTF-8"
            href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css"
            />
            <link
              rel="stylesheet"
              type="text/css"
              href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css"
              />
            <link href="{{ asset('/style.css')}}" rel="stylesheet" />
        </Head>
        <div dir="rtl">
          ////////////
          @include('site.layouts.header')

          @yield('content')
          @include('site.layouts.footer')

            <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
            <div id="preloader"></div>

            <script src="{{ asset('/vendor/jquery/jquery.min.js')}}"></script>
            <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{ asset('/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
            <script src="{{ asset('/vendor/php-email-form/validate.js')}}"></script>
            <script src="{{ asset('/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
            <script src="{{ asset('/vendor/counterup/counterup.min.js')}}"></script>
            <script src="{{ asset('/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
            <script src="{{ asset('/vendor/aos/aos.js')}}"></script>

            <script src="{{ asset('/js/main.js')}}"></script>
            @yield('script')

        </div>
