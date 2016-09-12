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
                    编辑用户
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li><a href="{{ url('admin/users') }}">用户管理－用户</a></li>
                    <li class="active">用户管理－编辑用户</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @include('../admin/alert')


                <div class="row">
                    <div class="col-xs-12">
                        <form role="form" method="POST" action="{{ url('admin/users/'.$user->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">

                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基础信息</a>
                                    </li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">其他信息</a></li>


                                    <li class="pull-right"><a href="{{ url('admin/users') }}" class="text-muted"><i
                                                    class="fa fa-user"></i></a></li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab_1">


                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="email">登录邮箱
                                                    <small class="text-red">*</small>
                                                </label>
                                                <input type="email" class="form-control" name="email"
                                                       placeholder="Enter email" value="{{ $user->email }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">用户名
                                                    <small class="text-red">*</small>
                                                </label>
                                                <input type="text" class="form-control" name="name"
                                                       placeholder="Enter name" value="{{ $user->name }}" disabled>
                                            </div>


                                            <div class="form-group">
                                                <label>角色（用户组）
                                                    <small class="text-red">*</small>
                                                </label>
                                                <div class="input-group">
                                                    <select ui-jq="chosen" class="form-control chosen-select "
                                                            style="min-width:200px;" name="role">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" {{ ($role->name === 'Demo') ? 'selected':'' }}>{{ $role->display_name }}
                                                                ({{ $role->name }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{--<div class="form-group">--}}
                                            {{--<label for="password">登录密码<small class="text-red">*</small></label>--}}
                                            {{--<input type="password" class="form-control" name="password" placeholder="Password">--}}
                                            {{--</div>--}}

                                            {{--<div class="form-group">--}}
                                            {{--<label for="password1">确认登录密码<small class="text-red">*</small></label>--}}
                                            {{--<input type="password" class="form-control" name="password_confirmation" placeholder="password confirmation">--}}
                                            {{--</div>--}}


                                        </div><!-- /.box-body -->


                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">


                                        <div class="form-group">
                                            <label for="nickname">昵称</label>
                                            <input type="text" class="form-control" name="nickname"
                                                   placeholder="Enter nickname" value="{{ $user->nickname }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">手机号码</label>
                                            <input type="text" class="form-control" name="phone"
                                                   placeholder="Enter phone" value="{{ $user->phone }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="status">状态</label>
                                            <div class="radio">
                                                <label class="radio-inline" for="radiogroup">
                                                    <input type="radio" name="status"
                                                           value="0" {{ ($user->status === 0) ? 'checked' : '' }}>
                                                    否</label>

                                                <label class="radio-inline" for="radiogroup">
                                                    <input type="radio" name="status"
                                                           value="1" {{ ($user->status === 1) ? 'checked' : '' }}>
                                                    是</label>
                                            </div>

                                        </div>

                                    </div><!-- /.tab-pane -->


                                </div><!-- /.tab-content -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div><!-- nav-tabs-custom -->
                        </form>

                    </div>
                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')

    </div><!-- ./wrapper -->



@endsection
