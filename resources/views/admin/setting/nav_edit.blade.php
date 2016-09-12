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
                    编辑导航
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li><a href="{{ url('admin/nav') }}">导航管理</a></li>
                    <li class="active">编辑导航</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @include('../admin/widget/alert')


                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="{{ url('admin/nav/'.$data->id) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">

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
                                                <label>导航名称</label>
                                                <input type="text" class="form-control"
                                                       placeholder="请输入分类名称" name="name" value="{{ $data->name }}">
                                            </div>

                                            <div class="form-group">
                                                <label>链接</label>
                                                <input type="text" class="form-control"
                                                       placeholder="" name="url" value="{{ $data->url }}">
                                            </div>


                                            <div class="form-group">
                                                <label for="status">状态</label>
                                                <div class="radio">
                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status"
                                                               value="0" {{ $data->status==0?'checked':'' }}>
                                                        否</label>

                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status"
                                                               value="1" {{ $data->status==1?'checked':'' }}>
                                                        是</label>
                                                </div>
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
