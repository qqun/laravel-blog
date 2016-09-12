<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="/theme/lte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- /Theme style -->
    <link href="/theme/lte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/theme/lte/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="/theme/lte/index2.html"><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">登录开始您的会话</p>
        <p class="login-box-msg">{{ Session::get('message') }}</p>
        <form action="{{ url('auth/login') }}" method="POST" id="form_login">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="account" id="account" value="{{ Input::old('email') }}" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  {{--<input type="checkbox" name="remember"> Remember Me--}}
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        {{--<div class="social-auth-links text-center">--}}
          {{--<p>- OR -</p>--}}
          {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>--}}
          {{--<a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>--}}
        {{--</div><!-- /.social-auth-links -->--}}

        {{--<a href="#">I forgot my password</a><br>--}}
        {{--<a href="register.html" class="text-center">Register a new membership</a>--}}

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="/theme/lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/theme/lte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/theme/lte/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });


      });



      $(function(){

        // $('.btn-primary').click(function(){
          
        //   var account = $("input#account").val();
        //   var password = $("input#password").val();
        //   if(account == '' || password == ''){
        //     alert('Input is empty');
        //     return;
        //   }
        //   $.ajax({
        //     url:'{{ url("auth/login") }}',
        //     method:'POST',
        //     dataType:'json',
        //     data:{
        //       account:$("input#account").val(),
        //       password:$("input#password").val(),
        //       _token:$("input#token").val(),
        //     },
        //     error:function(){
        //       alert('Network error');
        //       return;
        //     },
        //     success:function(response){
        //       var login_status = response.login_status;
        //       setTimeout(function(){
        //         if(login_status == 'invalid'){
        //           alert('error');
        //         }
        //         else
        //           if(login_status == 'success'){
        //             setTimeout(function(){
        //               window.location.href = response.redirect_url;
        //             }, 400);
        //           }
        //       }, 1000);
        //     }
        //   });
        // });


      });
    </script>
  </body>
</html>