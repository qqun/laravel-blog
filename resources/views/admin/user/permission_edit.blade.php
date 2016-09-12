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
                    编辑角色
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li class="active">用户管理－编辑角色</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">


                <div class="row">
                    <div class="col-xs-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Forms</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ url('admin/roles/'.$role->id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="InputName">角色标识</label>
                                        <input type="text" class="form-control" id="InputName" placeholder="Enter label"
                                               name="name" value="{{ $role->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDisplayName">显示名称</label>
                                        <input type="display_name" class="form-control" id="InputDisplayName"
                                               placeholder="Enter display_name" name="display_name"
                                               value="{{ $role->display_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDescription">描述</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..."
                                                  id="InputDescription">{{ $role->description }}</textarea>
                                    </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')


    </div><!-- ./wrapper -->



@endsection
