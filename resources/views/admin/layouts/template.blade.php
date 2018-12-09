<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <title>
    Wear Shop
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport'/>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="/assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet"/>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/assets/demo/demo.css" rel="stylesheet"/>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="/css/datatables.css"/>
  @yield('link')
  <style>
    @yield('style')
  </style>
</head>

<body class="">
<div class="wrapper ">
  @component('admin.component.sidebar')
  @endcomponent

  <div class="main-panel">
    @component('admin.component.navbar')
    @endcomponent

    @yield('main')

    @component('admin.component.footer')
    @endcomponent
  </div>
</div>
<!--   Core JS Files   -->
<script src="/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Chartist JS -->
<script src="/assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
<script src="/admin/js/bootstrap-notify.min.js" type="text/javascript"></script>
<script>
  $(".nav>li").each(function () {
    var navItem = $(this);
    if (navItem.find('a').attr('href') == location.pathname) {
      navItem.addClass('active');
    }
  });
</script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@yield('javascript')
</body>

</html>/html>
