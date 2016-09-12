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
                    系统设置
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li class="active">控制面板－系统设置</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="{{ url('admin/setting') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">网站参数</a>
                                    </li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">系统参数</a></li>
                                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">其他参数</a></li>

                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">


                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>网址标题</label>
                                                <input type="text" class="form-control" name="title"
                                                       placeholder="Enter title" value="{{ $setting['title'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>网址关键字</label>
                                                <input type="text" class="form-control" name="keywords"
                                                       placeholder="Enter keywords" value="{{ $setting['keywords'] }}">
                                                <small class="text-green">关键字之间使用英文逗号分割</small>
                                            </div>

                                            <div class="form-group">
                                                <label>网址描述</label>
                                                <textarea class="form-control"
                                                          name="description"> {{ $setting['description'] }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">系统状态</label>
                                                <div class="radio">
                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status"
                                                               value="0" {{ $setting['status']==0?'checked':'' }}>
                                                        维护</label>

                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status"
                                                               value="1" {{ $setting['status']==1?'checked':'' }}>
                                                        启用</label>
                                                </div>
                                            </div>

                                        </div><!-- /.box-body -->


                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label>标题图片</label>
                                                <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i
                                                            class="fa fa-fw fa-picture-o"></i>上传</a>
                                                <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i
                                                            class="fa fa-fw fa-eye"></i> 预览</a>
                                                <input type="text" name="thumb" id="thumb" class="form-control"
                                                       value="{{ $setting['thumb'] }}">
                                                <div id="layerPreviewPic" style="display: none;"></div>
                                                @include('../admin/widget/upfile')
                                                <small class="text-green">作为页面顶部图片,全屏图片建议1920px宽以上</small>
                                            </div>


                                        </div><!-- /.box-body -->
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                        <div class="box-body">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s,
                                            when an unknown printer took a galley of type and scrambled it to make a
                                            type
                                            specimen book.
                                            It has survived not only five centuries, but also the leap into electronic
                                            typesetting,
                                            remaining essentially unchanged. It was popularised in the 1960s with the
                                            release of
                                            Letraset
                                            sheets containing Lorem Ipsum passages, and more recently with desktop
                                            publishing
                                            software
                                            like Aldus PageMaker including versions of Lorem Ipsum.
                                        </div><!-- /.box-body -->
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
