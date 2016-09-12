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
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章列表</a></li>


                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">

                                    <!-- start content category-->
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                        <thead>
                                        <tr role="row">
                                            <th>编号</th>
                                            <th>标题</th>
                                            <th>分类</th>
                                            <th>添加时间</th>
                                            <th>显示</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach($data as $art)

                                            <tr role="row" class="odd">
                                                <td>{{ $art->id }}</td>
                                                <td class="text-green">{{ $art->title }}</td>
                                                <td>{{ isset($catData[$art->cat_id])?$catData[$art->cat_id]:'无分类，请编辑' }}</td>
                                                <td>{{ $art->created_at }}</td>
                                                <td>{!! getStatus($art->status, $art->id) !!}</td>
                                                <td>


                                                    <a href="{{ URL('/admin/article/'.$art->id.'/edit') }}"
                                                       class="active m-l-xs" ui-toggle-class>
                                                        <i class="fa fa-fw fa-edit text-primary"></i></a>

                                                    <a href="javascript:void();" class="active m-l-xs m-l trash"
                                                       ui-toggle-class data-id="{{ $art->id }}">
                                                        <i class="fa fa-fw fa-trash text-danger"></i></a>


                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>


                                    </table>


                                    <!-- end -->

                                </div><!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <!-- start form category-->

                                    <!-- end -->
                                </div><!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <!-- start diy category-->


                                    <!-- end -->
                                </div><!-- /.tab-pane -->


                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info page_total">总{{ $data->total() }} 条记录</div>
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                                            <?php echo $data->render(); ?>
                                        </div>
                                    </div>
                                </div>


                            </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                    </div><!-- /.col -->


                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')


        <script type="text/javascript" src="/js/action.js"></script>
    </div><!-- ./wrapper -->



@endsection
