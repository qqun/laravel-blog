<!DOCTYPE html>
<html class="no-js" lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $head['title']}}</title>
    <meta name="keywords" content="{{ $head['keyword'] }}"/>
    <meta name="description" content="{{ $head['description'] }}"/>


    {{--<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,300,400italic,600&subset=latin,latin-ext"--}}
          {{--rel="stylesheet" type="text/css">--}}

    <link href="/theme/hueman/fonts/font-awesome.min.css" rel="stylesheet">

    <link rel='stylesheet' id='style-css' href='/theme/hueman/style.css?ver=4.4.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='responsive-css'
          href='/theme/hueman/responsive.css?ver=4.4.1' type='text/css' media='all'/>

    <script src="https://cdn.bootcss.com/jquery/1.12.0/jquery.min.js"></script>

    <script type="text/javascript" src="/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
    <link rel="stylesheet" href="/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css">
    <script type="text/javascript">
        SyntaxHighlighter.all();
    </script>
    <style>
        table .code{
            padding:9.5px 0 9.5px 9.5px!important
        }
        .none{display: none}
    </style>

    <!--[if lt IE 9]>
    <script src="theme/hueman/js/ie/html5.js"></script>
    <script src="theme/hueman/js/ie/selectivizr.js"></script>
    <![endif]-->
    <style type="text/css">
        /* Dynamic CSS: For no styles in head, copy and put the css below in your child theme's style.css, disable dynamic styles */
        body {
            font-family: "Source Sans Pro", Arial, sans-serif;
        }
    </style>
</head>



@yield('content')

</div>
<script type='text/javascript' src='/theme/hueman/js/scripts.js?ver=4.4.1'></script>
<!--[if lt IE 9]>
<script src="/theme/hueman/js/ie/respond.js"></script>
<![endif]-->


</div>
</body>
</html>