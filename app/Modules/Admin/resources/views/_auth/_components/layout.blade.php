<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <title>{{config('app.name')}} | Login as admin</title>
    <meta name="description" content="{{config('app.name')}} Login">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js">
    </script>
    <script>
      WebFont.load({
        google: {
          "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]}
        ,
        active: function () {
          sessionStorage.fonts = true;
        }
      });
    </script>
    <link href="{!! asset('plugins/user/images/logo-blue.svg') !!}" rel="shortcut icon" type="image/png" />
    <link href="{!! asset('plugins/portal/vendors/base/vendors.bundle.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/portal/demo/default/base/style.bundle.css') !!}" rel="stylesheet" type="text/css"/>
  </head>
  <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    {{ $slot }}
    <footer>
      <script src="{!! asset('plugins/portal/vendors/base/vendors.bundle.js') !!}" type="text/javascript"></script>
      <script src="{!! asset('plugins/portal/demo/default/base/scripts.bundle.js') !!}" type="text/javascript"></script>
      <script src="{!! asset('plugins/portal/js/toastr.min.js') !!}" type="text/javascript"></script>
    </footer>
  </body>
  @if(session()->has('error'))
  <script type="text/javascript">toastr.error("{{session('error')}}");</script>
  @endif
</html>
