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

                <script src="/js/ckeditor447/ckeditor.js"></script>
                <script src="/js/ckfinder/ckfinder.js"></script>


                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="#" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">网站参数</a>
                                    </li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">系统参数</a></li>
                                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">其他参数</a></li>
                                    <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Ckeditor</a>
                                    </li>
                                    <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Ueditor</a>
                                    </li>


                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">


                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                       placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                       placeholder="Password">
                                            </div>

                                            <div class="form-group">
                                                <label>Category List</label>
                                                <div class="input-group">
                                                    <select ui-jq="chosen" class="form-control chosen-select "
                                                            style="min-width:200px;">
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label>Tags</label>
                                                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"
                                                      rel="stylesheet"/>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

                                                <select class="js-example-tags form-control" multiple="" tabindex="-1"
                                                        aria-hidden="true" name="tags[]">
                                                </select>
                                                <small class="text-green">按Enter 输入新tag</small>
                                                <script>
                                                    $(".js-example-tags").select2({
                                                        tags: true,
                                                    })
                                                    $(".select2-selection--multiple").css('border', '1px solid #d2d6de').css('border-radius', 0);

                                                </script>
                                            </div>


                                            <div class="form-group">
                                                <label>标题图片</label>
                                                <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i
                                                            class="fa fa-fw fa-picture-o"></i>上传</a>
                                                <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i
                                                            class="fa fa-fw fa-eye"></i> 预览</a>
                                                <input type="text" name="thumb" id="thumb" class="form-control"
                                                       value="{{ Input::old('thumb') }}">
                                                <div id="layerPreviewPic" style="display: none;"></div>
                                                @include('../admin/widget/upfile')
                                            </div>


                                        </div><!-- /.box-body -->


                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> System Status
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Is Show</label>
                                                <div class="radio">
                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status" value="0">
                                                        No</label>

                                                    <label class="radio-inline" for="radiogroup">
                                                        <input type="radio" name="status" value="1" checked>
                                                        Yes</label>
                                                </div>
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

                                    <div class="tab-pane" id="tab_4">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Ckeditor</label>
                                                <textarea class="form-control" name="content" id="editorx"></textarea>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                    <div class="tab-pane" id="tab_5">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Ckeditor</label>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>

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
