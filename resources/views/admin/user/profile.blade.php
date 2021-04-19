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
                        <form role="form" method="POST" action="{{ url('admin/profile/'.$user->id) }}">
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
                                                <label for="password">原密码
                                                    <small class="text-red">*</small>
                                                </label>
                                                <input type="password" class="form-control" name="password_origin"
                                                       placeholder="Password origin">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">新密码
                                                    <small class="text-red">*</small>
                                                </label>
                                                <input type="password" class="form-control" name="password_new"
                                                       placeholder="Password new">
                                            </div>

                                            <div class="form-group">
                                                <label for="password1">确认新密码
                                                    <small class="text-red">*</small>
                                                </label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                       placeholder="password confirmation">
                                            </div>


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
                                            <label for="text">头像</label>
                                            <div style="width:200px;height:200px;position:relative;">
                                                <input type="hidden" class="form-control" id="thumb" data-id="thumb"
                                                       name="thumb" value="{{ $user->avatar }}" oninput="showThumb(this)">
                                                {{--<input type="hidden" class="form-control" id="avatarInput" name="avatarInput" value="">--}}
                                                <img name="avatar" id="avatar" src="{{ $user->avatar }}"
                                                     style="width:200px;height:200px;"/>
                                            </div>
                                        </div>

                                    </div><!-- /.tab-pane -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>


                                </div><!-- /.tab-content -->

                            </div><!-- nav-tabs-custom -->
                        </form>


                    </div>
                </div>


            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('../admin/footer')
        <script src="{!!asset('js/plugins/layer/1.8.5/layer.min.js')!!}"></script>
        <script type="application/javascript">
   


            $('#avatar').click(function () {
                var ele = $(this).data('id');

                $.layer({
                    type: 2,
                    shade: [0.5, '#000', true],
                    border: [0],
                    title: false,
                    closeBtn: false,
                    shadeClose: true,
                    fix: false,
                    iframe: {src: '{{ url('admin/upload') }}'},
                    area: ['600px', '250px'],
                    offset: ['', ''],
                    success: function (layero) {
                        //								console.log(layero);
                        $(layero['selector'] + ' .xubox_main').css('border-radius', '6px');
                        $(layero['selector'] + ' .xubox_iframe').css('border-radius', '6px');
                        /*
                         $('#xubox_layer1 .xubox_main').css('border-radius','3px');
                         $('#xubox_layer1 .xubox_iframe').css('border-radius','3px');
                         */

                    },
                    close: function (index) {
                        layer.closeAll();
                    },
                    end: function (index) {
                        //location.reload();
                    }
                });
            });


            function showThumb(obj) {
                console.log(obj);
                $('#avatar').attr('src', obj);
//                        $('#avatarInput').val(obj);
            }

            function call_back2(obj) {
                $('#avatar').attr('src', obj);
            }



        </script>

    </div><!-- ./wrapper -->



@endsection
