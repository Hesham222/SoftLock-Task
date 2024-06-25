<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Admin | {{ $pageTitle }}</title>
    <meta name="description" content="{{config('app.name')}} admin panel">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{asset('plugins/portal/media/img/favicon.png')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>--}}
        <style>
            .bar{
                background-color: #00ff00;
            }
            .percent{
                position: absolute;
                left: 50%;
                color: black;
            }
        </style>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="{!! asset('plugins/portal/vendors/base/vendors.bundle.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('plugins/portal/demo/default/base/style.bundle.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('plugins/portal/vendors/custom/datatables/datatables.bundle.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('plugins/portal/vendors/custom/fullcalendar/fullcalendar.bundle.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('plugins/portal/css/toastr.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('plugins/portal/css/summernote.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('plugins/portal/css/dropzone.css') !!}" rel="stylesheet" type="text/css">
        {{ $style }}
    </head>

    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <x-admin::layout.header />
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                {{ $slot }}
            </div>
       </div>
        <x-admin::layout.sidebar />
        <footer class="m-grid__item m-footer ">
            <div class="m-container m-container--fluid m-container--full-height m-page__container">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                        <span class="m-footer__copyright">
                            {{date('Y')}} &copy; {{config('app.name')}} Admin Portal | Developed by
                            <a href="http://hypermedialabs.com/" target="_blank" class="m-link">Hypermedia labs</a>
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <script src="{!! asset('plugins/portal/vendors/base/vendors.bundle.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/demo/default/base/scripts.bundle.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/vendors/custom/fullcalendar/fullcalendar.bundle.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js/dashboard.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/vendors/custom/datatables/datatables.bundle.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js/jquery.dataTables.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js/dataTables.bootstrap4.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/demo/default/custom/crud/datatables/advanced/row-callback.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js/sweetalert.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js/toastr.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js/summernote.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js/dropzone.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/portal/js//general.js') !!}" type="text/javascript"></script>
    @if(session()->has('success'))
        <script type="text/javascript">toastr.success("{{session('success')}}");</script>
    @endif
    @if(session()->has('error'))
        <script type="text/javascript">toastr.error("{{session('error')}}");</script>
    @endif
    {{ $scripts }}
    </body>
</html>
