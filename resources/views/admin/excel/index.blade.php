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
                    数据管理
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li class="active">数据管理－数据列表</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <a href="{{ url('admin/excel/improt') }}" class="btn btn-primary margin-bottom">导入数据表</a>

                @include('../admin/alert')

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title ">导入数据列表</h3>

                                <div class="box-tools">
                                    <form action="{{ url('admin/users') }}" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm pull-right" name="s_name"
                                                   value="" style="width: 150px;" placeholder="搜索用户登录邮箱或昵称">
                                            <input type="text" class="form-control input-sm pull-right" name="s_phone"
                                                   value="" style="width: 120px;border-right:none;"
                                                   placeholder="搜索用户手机号">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
                                                    <th>邮箱[用户名]</th>
                                                    <th>角色[用户组]</th>
                                                    <th>创建时间</th>
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($data as $us)

                                                    <tr role="row" class="odd">
                                                        <td>{{ $us->id }}</td>
                                                        <td class="text-green">{{ $us->email }}[{{ $us->name }}]</td>
                                                        <td>
                                                            @if(null !== $us->roles->first())  {{-- 某些错误情况下，会造成管理用户没有角色 --}}
                                                            {{ $us->roles->first()->name }}
                                                            @else
                                                                空(NULL)
                                                            @endif
                                                        </td>
                                                        <td class="sorting_1">{{ $us->created_at }}</td>
                                                        <td>
                                                            @if(!$us->status)
                                                                锁定
                                                            @else
                                                                正常
                                                            @endif
                                                        </td>
                                                        <td>


                                                            <a href="{{ URL('/admin/users/'.$us->id.'/edit') }}"
                                                               class="active" ui-toggle-class>
                                                                <i class="fa fa-edit text-primary text-active"></i></a>

                                                            <a href="javascript:void();" class="active m-l-xs m-l"
                                                               ui-toggle-class>
                                                                <i class="fa fa-recycle text-danger text-active"></i></a>

                                                            <form action="{{ URL('/admin/users/'.$us->id) }}"
                                                                  method="POST" style="display: inline">
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                       value="{{ csrf_token() }}">
                                                                <button class="active m-l-xs none-border"
                                                                        ui-toggle-class
                                                                        onclick="return confirm('确定删除么？ 不可恢复哦！');"><i
                                                                            class="fa fa-recycle text-danger text-active"></i>
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>


                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="dataTables_info page_total">总 x 条记录</div>
                                        </div>

                                        <div class="col-sm-7">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                 id="example2_paginate">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->


                        <!--隐藏型删除表单-->
                        <form action="{{ url('/admin/users/') }}" method="POST" id="hidden-delete-form"></form>


                    </div><!-- /.col -->
                </div>


        </div><!-- /.row -->


        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('../admin/footer')

    @include('../admin/right')


    </div><!-- ./wrapper -->



@endsection
