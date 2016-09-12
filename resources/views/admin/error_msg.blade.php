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
                        <h4><i class="icon fa fa-ban"></i> 操作提示：当前操作错误，如有疑问请联系管理员</h4>
                        <p>{{ $message }}</p>
                        <p><i id="number">5</i>秒后跳转，或<a href="{{ $url }}">手动跳转</a></p>
                        <input type="hidden" id='url' value="{{ $url }}">
                    </div>

                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')

        @include('../admin/right')

    </div><!-- ./wrapper -->

    <script type="text/javascript">
        $(document).ready(function () {

            var seconds = 6;
            var url = $('#url').val();

            function redirect() {
                seconds--;
                $('#number').innerHTML = seconds;
                if (seconds <= 0) {
//        window.clearInterval();
                    $('#number').innerHTML = 0;
                    location.href = url;
                }
            }

            window.setInterval(redirect, 1000);

        });
    </script>

@endsection
