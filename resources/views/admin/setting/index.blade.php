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
                                                <small class="text-green">关键字之间使用英文逗号分割</small>
                                                <input type="text" class="form-control" name="keywords"
                                                       placeholder="Enter keywords" value="{{ $setting['keywords'] }}">

                                            </div>

                                            <div class="form-group">
                                                <label>网址描述</label>
                                                <textarea class="form-control"
                                                          name="description">{{ $setting['description'] }}</textarea>
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
                                    <div class="tab-pane " id="tab_2">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label>标题图片</label>
                                                <small class="text-blue">作为页面顶部图片,全屏图片建议1920px宽以上,数量5以内</small>
                                                <div class="form-group">
                                                    @foreach($setting['thumb'] as $pic)
                                                        <div style="width:100px; text-align:center; margin: 5px; display:inline-block;"
                                                             class="image_xc">
                                                            <input type="hidden" value="{{ $pic }}" name="thumb[]">
                                                            <a onclick="" href="{{ $pic }}" target="_blank">
                                                                <img width="100" height="100" src="{{ $pic }}"/>
                                                            </a>
                                                            <br>
                                                            <a href="javascript:void(0)"
                                                               onclick="ClearPicArr2(this,'{{ $pic }}')">删除</a>
                                                        </div>
                                                    @endforeach
                                                    <div class="image_xc"
                                                         style="width:100px;height:100px; text-align:center; margin: 5px; display:inline-block;">
                                                        <input type="hidden" name="thumb[]" value=""/>
                                                        <a href="javascript:void(0);" class="uploadPic">
                                                            <img src="/assets/blog/add-button.jpg" width="100"
                                                                 height="100"/>
                                                        </a>
                                                        <br/>
                                                        <a href="javascript:void(0)">&nbsp;&nbsp;</a>
                                                    </div>
                                                </div>
                                                @include('../admin/widget/upfile')
                                                <script type="text/javascript">
                                                    function ClearPicArr2(obj, path) {
                                                        // 删除后保存
                                                        $(obj).parent().remove();
                                                    }

                                                    function call_back2(paths) {
                                                        console.log(paths);
                                                        var last_div = $(".image_xc:last").prop("outerHTML");
                                                        $(".image_xc:eq(0)").before(last_div);	// 插入一个 新图片
                                                        $(".image_xc:eq(0)").find('a:eq(0)').attr('href', paths).attr('onclick', '').attr('target', "_blank");// 修改他的链接地址
                                                        $(".image_xc:eq(0)").find('img').attr('src', paths);// 修改他的图片路径
                                                        $(".image_xc:eq(0)").find('a:eq(1)').attr('onclick', "ClearPicArr2(this,'" + paths + "')").text('删除');
                                                        $(".image_xc:eq(0)").find('input').val(paths); // 设置隐藏域 要提交的值
                                                    }


                                                    function GetUploadify() {
                                                        //
                                                    }


                                                </script>
                                            </div>


                                        </div><!-- /.box-body -->
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>前台文章列表数量</label>
                                                <small class="text-blue">参数只影响前台显示</small>
                                                <input type="text" class="form-control" name="pagesize"
                                                       placeholder="Enter Size" value="{{ $setting['pagesize'] }}">

                                            </div>

                                            <div class="form-group">
                                                <label>网站模版</label>
                                                <small class="text-blue">参数只影响前台显示</small>
                                                <input type="text" class="form-control" name="themes"
                                                       placeholder="Enter themes" value="{{ $setting['themes'] }}">

                                            </div>

                                            <div class="form-group">
                                                <label>网站维护状态提示</label>
                                                <textarea class="form-control"
                                                          name="note">{{ $setting['note'] }}</textarea>
                                            </div>


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
