<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="/theme/lte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="/theme/lte/lib/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="/theme/lte/lib/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- jvectormap -->
    <link href="/theme/lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="/theme/lte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="/theme/lte/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>

    <link href="/theme/lte/dist/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/plugins/layer/2.2/layer.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/theme/lte/lib/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="/theme/lte/lib/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-black-light sidebar-mini">

@yield('content')

        <!-- Bootstrap 3.3.2 JS -->
<script src="/theme/lte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='/theme/lte/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="/theme/lte/dist/js/app.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="/theme/lte/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="/theme/lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="/theme/lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="/theme/lte/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="/theme/lte/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="/theme/lte/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="/theme/lte/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>


<!--引入Chosen组件-->
<!--select下拉插件 chosen-->
<link href="/theme/lte/plugins/chosen/chosen.css" rel="stylesheet" type="text/css"/>

<script src="/theme/lte/plugins/chosen/chosen.jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 15},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: '95%'}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
<!--select下拉插件 chosen-->


</body>
</html>
