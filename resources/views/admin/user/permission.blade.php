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
                    用户管理
                    <small>权限</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ $admin_path }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li class="active">用户管理－权限</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">


                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title ">权限列表</h3>
                                <div class="box-tips clearfix text-info">
                                    <b>权限影响系统安全与稳定，错误或不合理的修改可能会影响系统业务与逻辑，故在此屏蔽掉权限 增、删、改 功能。</b><br/>开发者可通过阅读 Laravel <a
                                            href="https://github.com/Zizaco/entrust/tree/laravel-5">Entrust</a>
                                    文档，结合本内容管理框架实际，来完成相关（二次）开发任务。
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example2" class="table table-bordered table-hover dataTable"
                                                   role="grid">
                                                <thead>
                                                <tr role="row">
                                                    <th>编号</th>
                                                    <th>权限标识</th>
                                                    <th>显示名称</th>
                                                    <th>创建时间</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($data as $dat)

                                                    <tr role="row" class="odd">
                                                        <td>{{ $dat->id }}</td>
                                                        <td class="text-green">{{ $dat->name }}</td>
                                                        <td>{{ $dat->display_name }}</td>
                                                        <td class="sorting_1">{{ $dat->created_at }}</td>
                                                        <td>


                                                            <a href="{{ URL($admin_path.'/permissions/'.$dat->id.'/edit') }}"
                                                               class="active" ui-toggle-class>
                                                                <i class="fa fa-edit text-primary text-active"></i></a>
                                                            <a href="{{ URL($admin_path.'/permissions/'.$dat->id.'/permission') }}"
                                                               class="active m-l-xs" ui-toggle-class>
                                                                <i class="fa fa-tasks text-primary text-active"></i></a>

                                                            <a href="javascript:void();" class="active m-l-xs m-l"
                                                               ui-toggle-class>
                                                                <i class="fa fa-recycle text-danger text-active"></i></a>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>


                                            </table>
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


                        <!--隐藏型删除表单-->
                        <form action="{{ url($admin_path.'/permissions/') }}" method="POST"
                              id="hidden-delete-form"></form>


                    </div><!-- /.col -->
                </div>


        </div><!-- /.row -->


        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('../admin/footer')
    </div><!-- ./wrapper -->



@endsection
