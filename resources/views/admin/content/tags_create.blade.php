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
                    添加标签
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li><a href="{{ url('admin/tags') }}">标签管理</a></li>
                    <li class="active">添加标签</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @include('../admin/widget/alert')


                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="{{ url('admin/tags') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基本信息</a>
                                    </li>
                                    {{--<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">其他参数</a></li>--}}


                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">


                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>标签名称</label>
                                                <input type="text" class="form-control"
                                                       placeholder="请输入标签名称" name="name" {{ Input::old('name') }}>
                                            </div>


                                        </div><!-- /.box-body -->


                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <div class="box-body">

                                        </div>
                                    </div><!-- /.tab-pane -->


                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>


                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </form>
                    </div><!-- /.col -->


                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')


    </div><!-- ./wrapper -->



@endsection
