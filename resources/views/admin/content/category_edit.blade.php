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
                    编辑分类
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li><a href="{{ url('admin/cate') }}">分类管理</a></li>
                    <li class="active">编辑分类</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <script src="/js/ckeditor447/ckeditor.js"></script>
                <script src="/js/ckfinder/ckfinder.js"></script>


                @include('../admin/widget/alert')


                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="{{ url('admin/cate/'.$data->id) }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基本信息</a>
                                    </li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">其他参数</a></li>


                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">


                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>分类名称</label>
                                                <input type="text" class="form-control"
                                                       placeholder="请输入分类名称" name="title" value="{{ $data->title }}">
                                            </div>

                                            <div class="form-group">
                                                <label>别名</label>
                                                <input type="text" class="form-control"
                                                       placeholder="" name="alias" value="{{ $data->alias }}">
                                            </div>


                                            <div class="form-group">
                                                <label>上级分类</label>
                                                <div class="input-group">
                                                    <select ui-jq="chosen" class="form-control chosen-select "
                                                            style="min-width:200px;" name="pid">
                                                        <option value="0" {{ $data->id == 0 ? 'selected' : ''  }}>
                                                            作为顶级分类
                                                        </option>
                                                        @foreach($catdata as $cat)
                                                            <option value="{{ $cat->id }}" {{ $cat->id == $data->pid ? 'selected' : ''  }}>{{ $cat->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                            <div class="form-group">
                                                <label>栏目图片</label>
                                                <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i
                                                            class="fa fa-fw fa-picture-o"></i>上传</a>
                                                <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i
                                                            class="fa fa-fw fa-eye"></i> 预览</a>
                                                <input type="text" name="thumb" id="thumb" class="form-control"
                                                       value="{{ $data->thumb }}">
                                                <div id="layerPreviewPic" style="display: none;"></div>
                                                @include('../admin/widget/upfile')
                                            </div>


                                            <div class="form-group">
                                                <label>关键字</label>
                                                <input type="text" class="form-control" placeholder="Enter seo keywords"
                                                       name="keywords" value="{{ $data->keywords }}">
                                            </div>

                                            <div class="form-group">
                                                <label>描述</label>
                                                <textarea class="form-control"
                                                          name="description">{{ $data->description }}</textarea>
                                            </div>

                                            <div class="form-group none">
                                                <label>跳转链接</label>
                                                <input type="text" class="form-control"
                                                       placeholder="" name="http" value="{{ $data->http }}">
                                            </div>

                                            <div class="form-group none">
                                                <label>排序</label>
                                                <input type="text" class="form-control"
                                                       placeholder="" name="sort" value="{{ $data->sort }}">
                                            </div>
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


                <script type="application/javascript">
                    var editor = CKEDITOR.replace('editorx', {
                        uiColor: '#ffffff'
                    });

                    CKFinder.setupCKEditor(editor, '/js/ckfinder/');
                </script>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')


    </div><!-- ./wrapper -->



@endsection
