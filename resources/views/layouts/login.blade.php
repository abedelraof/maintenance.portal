<!DOCTYPE html>
<html direction="rtl" style="direction: rtl;" lang="en">
<!--begin::Head-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ currentConnection()->account_name }}</title>

    <!--begin::Page Custom Styles(used by this page)-->
    <link href="/css/login-1.css" rel="stylesheet" type="text/css">
    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="/css/plugins.bundle.rtl.css" rel="stylesheet" type="text/css">
    <link href="/css/style.bundle.rtl.css" rel="stylesheet" type="text/css">
    <!--end::Global Theme Styles-->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Tajawal', sans-serif !important;
        }
    </style>

</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled">

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto"
             style="background-color: #7EBFDB;background: linear-gradient(45deg, #6741a5, #7EBFDB);justify-content:center">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column">
                <!--begin::Aside header-->
                <a href="#" class="text-center mb-15">
                    <img src="{{ currentConnection()->login_account_logo }}" alt="logo"
                         style="max-height: 200px !important;max-width: 60% !important;">
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg text-white"
                    style="line-height: 40px">
                    {{ currentConnection()->account_name }}
                    <br>
                    سنوات من الخبرة
                </h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
        {{--            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"--}}
        {{--                 style="background-image: url(img/payment.svg)"></div>--}}
        <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->

        @yield("content")

    </div>
    <!--end::Login-->
</div>
<!--end::Main-->


</body>
<!--end::Body-->
</html>
