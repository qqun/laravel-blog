@extends('../admin')


@section('content')
    @include('UEditor::head')
    <div class="wrapper">
        @include('../admin/header')

                <!-- Left side column. contains the logo and sidebar -->
        @include('../admin/sidebar')


                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    编辑文章
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li><a href="{{ url('admin/article') }}">文章管理</a></li>
                    <li class="active">编辑文章</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @include('../admin/alert')

                <script src="/js/ckeditor447/ckeditor.js"></script>
                <script src="/js/ckfinder/ckfinder.js"></script>


                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="{{ url('admin/article/'.$data->id) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">

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
                                                <label>文章标题</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter article title"
                                                       name="title" value="{{ $data->title }}">
                                            </div>


                                            <div class="form-group">
                                                <label>所属分类</label>
                                                <div class="input-group">
                                                    <select ui-jq="chosen" class="form-control chosen-select "
                                                            style="min-width:200px;" name="cat_id">
                                                        @foreach($catData as $cat)
                                                            <option value="{{ $cat->id }}" {{ $cat->id == $data->cat_id?'selected':'' }}>{{ $cat->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Tags</label>

                                                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"
                                                      rel="stylesheet"/>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

                                                <select class="js-example-tags form-control" multiple="" tabindex="-1" class="form-control"
                                                        aria-hidden="true" name="tags[]">
                                                    @foreach($tagsData as $t)
                                                        <option value="{{ $t->name }}" {{ in_array($t->id, $tags)?'selected':'' }}>{{ $t->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-green">按Enter 输入新tag</small>

                                                <script>
                                                    $(".js-example-tags").select2({
                                                        tags: true,
                                                    })
                                                    $(".select2-selection--multiple").css('border','1px solid #d2d6de').css('border-radius',0);
                                                    // $(".select2-container--below").css('width','100%');

                                                </script>


                                            </div>

                                            <div class="form-group">
                                                <label>文章内容</label>
                                                <script type="text/plain" id="container" name="content">{!! $data->content !!}</script>
                                            </div>


                                            <div class="form-group">
                                                <label for="status">是否显示</label>
                                                <div class="radio">
                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status"
                                                               value="0" {{ $data->status==0?'checked' :''}}>
                                                        否</label>

                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status"
                                                               value="1" {{ $data->status==1?'checked' :''}}>
                                                        是</label>
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
                                                       value="{{ $data->thumb }}">
                                                <div id="layerPreviewPic" style="display: none;"></div>
                                                @include('../admin/widget/upfile')
                                            </div>

                                            <div class="form-group none">
                                                <label>外链</label>
                                                <input type="text" class="form-control" placeholder="Enter url"
                                                       name="url" value="{{ $data->url }}">
                                            </div>


                                            <div class="form-group">
                                                <label>关键字</label>
                                                <input type="text" class="form-control" placeholder="Enter seo keywords"
                                                       name="keyword" value="{{ $data->keyword }}">
                                            </div>

                                            <div class="form-group">
                                                <label>描述（摘要）</label>
                                                <textarea class="form-control"
                                                          name="description">{{ $data->description  }}</textarea>
                                            </div>


                                            <div class="form-group">
                                                <label>作者</label>
                                                <input type="text" class="form-control" name="author"
                                                       value="{{ \Auth::user()->name }}">
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
                    var ue = UE.getEditor('container', {
                        initialFrameHeight : 450,
                    });
                </script>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')



    </div><!-- ./wrapper -->



@endsection
