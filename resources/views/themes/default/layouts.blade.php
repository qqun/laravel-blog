<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $head['title']}}</title>
    <meta name="keywords" content="{{ $head['keyword'] }}"/>
    <meta name="description" content="{{ $head['description'] }}"/>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/blog/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>


    <script type="text/javascript" src="/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
    <link rel="stylesheet" href="/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css">
    <script type="text/javascript">
        SyntaxHighlighter.all();
    </script>
    <style>
        table .code{
            padding:9.5px 0 9.5px 9.5px!important
        }
    </style>

</head>
<body>

@yield('content')


        <!-- Bootstrap 3.3.2 JS -->
<script src="//cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>