@extends('../admin')


@section('content')



    <div class="wrapper">
        @include('../admin/header')

                <!-- Left side column. contains the logo and sidebar -->
        @include('../admin/sidebar')


                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    异常
                    <small>Exception</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li class="active">异常</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">


                <div class="box-body">
                    <div class="callout callout-warning">
                        <h4><i class="icon fa fa-ban"></i> 异常警告：403错误 权限不足</h4>
                        <p>您没有权限访问当前页面内容，请联系超级管理员或访问其它页面节点！</p>
                    </div>

                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')

        @include('../admin/right')

    </div><!-- ./wrapper -->



@endsection
