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
                <h1 id="action" data-url="{{ url('admin/article/') }}">
                    文章管理
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li class="active">文章管理</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <a href="{{ url('admin/article/create') }}" class="btn btn-success margin-bottom">新增文章</a>
                @include('../admin/alert')

                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">文章列表</h3>
                                <div class="box-tools">
                                    <form action="{{ url('admin/article') }}" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm pull-right" name="title"
                                                   value="" style="width: 150px;" placeholder="搜索文章标题">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.box-header -->

                            <div class="box-body table-responsive">
                                <div class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <!-- start content category-->
                                            <table id="example2" class="table table-bordered table-hover dataTable"
                                                   role="grid">
                                                <thead>
                                                <tr role="row">
                                                    <th>编号</th>
                                                    <th>标题</th>
                                                    <th>分类</th>
                                                    <th>添加时间</th>
                                                    <th>显示</th>
                                                    <th>置顶</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($data as $art)

                                                    <tr role="row" class="odd">
                                                        <td>{{ $art->id }}</td>
                                                        <td class="text-green">{{ $art->title }}
                                                            @if(!empty($art->thumb))<span class="badge">图</span>@endif
                                                        </td>
                                                        <td>{{ isset($catData[$art->cat_id])?$catData[$art->cat_id]:'无分类，请编辑' }}</td>
                                                        <td>{{ $art->created_at }}</td>
                                                        <td>{!! getStatus($art->status, $art->id) !!}</td>
                                                        <td>{!! getStatus($art->type, $art->id,'type') !!}</td>
                                                        <td>
                                                            <a href="{{ url("article/$art->id") }}" target="_blank">
                                                                <i class="fa fa-fw fa-external-link"></i>预览
                                                            </a>
                                                            <a href="{{ URL('/admin/article/'.$art->id.'/edit') }}"
                                                               class="X-Small btn-xs text-success">
                                                                <i class="fa fa-fw fa-edit"></i>编辑</a>

                                                            <a href="javascript:void();"
                                                               class="X-Small btn-xs text-danger trash"
                                                               ui-toggle-class data-id="{{ $art->id }}">
                                                                <i class="fa fa-fw fa-trash-o"></i>删除</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>


                                            </table>

                                            <!-- end -->

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="dataTables_info page_total">总{{ $data->total() }} 条记录</div>
                                        </div>

                                        <div class="col-sm-7">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                 id="example2_paginate">

                                                <?php echo $data->render(); ?>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')

        <script type="text/javascript" src="/js/action.js"></script>
    </div><!-- ./wrapper -->


@endsection

