<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title> Upload File</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="/theme/lte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!--这里使用旧版jQuery-->
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>

    <style type="text/css">
        body {
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, '\5FAE\8F6F\96C5\9ED1', 'Hiragino Sans GB', sans-serif;
        }

        .close_button {
            margin-bottom: 25px;
        }

        .layer {
            width: 560px;
            margin: 0 20px;
        }

        .validation_tips_area {
            line-height: 36px;
            background-color: #f6f6f6;
            color: #666;
            border-radius: 12px;
        }

        .validation_tips_area .tips_text {
            margin: auto 20px;
            font-size: 18px;
            line-height: 36px;
        }

        .be_sad {
            color: #bb4848;
        }

        .be_happy {
            color: #051;
        }

        .fail_mask {
            background-color: #c00;
            color: #fff;
            padding: 3px 30px 3px 10px;
            font-size: 12px;
            line-height: 20px;
            min-width: 12px;
            font-size: 12px;
            border-radius: 3px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, .3);
        }

        .fail_mask p {
            margin: 0;
        }

        .info_text {
            color: #666;
        }

        .small_text {
            font-size: 12px;
        }

        /*覆写部分样式,以便适合弹窗*/
        .layer .validation_tips_area {
            width: 500px;
        }

        .layer ul li label.description, {
            line-height: 20px !important;
        }

        .layer ul li .form_item {
            line-height: 20px !important;
            margin: 5px 0;
        }

        .layer p.tips_text {
            color: #083;
            font-size: 12px;
            line-height: 20px;
            margin: 5px 0;
        }

        .avgrund-close {
            display: block;
            color: #555;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            position: absolute;
            top: 6px;
            right: 10px;
        }
    </style>
</head>
<body>
<div class="close_button"><a href="javascript:void(0);" class="avgrund-close">close</a>
</div>
<div class="layer">

    <div class="validation_tips_area" style="display: none;">
        <div class="tips_text">
            <p class="be_happy"><i class="fa fa-smile-o"></i> 上传文件成功！</p>
            <p class="info_text small_text">本提示栏2秒之后自动关闭！</p>
        </div>
    </div>

    <form method="post" action="{{url('admin/upload')}}" accept-charset="utf-8" enctype="multipart/form-data"
          id="uploadPictureForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="upload_picture_form">
            <div class="form-group">
                <label>上传文件</label>
                <p>
                    <small>支持文件类型{{ $fileType }}</small>
                </p>
                <input accept="{{ $fileType }}" name="file" type="file">
            </div>
            <button type="submit" class="btn btn-primary" id="uploadPicSubmit">上传</button>
        </div>
    </form>
</div>


<!-- <script src="/js/plugins/layer/layer.min.js"></script> -->
<script src="/js/plugins/form/jquery.form.js"></script>

<!-- <script type="text/javascript" src="{!!asset('js/plugins/layer/1.8.5/layer.min.js')!!}"></script>

<script type="text/javascript" src="{!!asset('js/jquery-2.1.1.min.js')!!}"></script>
 -->


<script type="text/javascript">

    //比如在iframe中关闭自身
    var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
    $('.avgrund-close').on('click', function () {
        parent.layer.close(index); //执行关闭
    });

    function build_html(status, info, operation) {
        if (status === 1) {
            var html = [
                '<div class="tips_text">',
                '<p class="be_happy"><i class="fa fa-smile-o"></i>  ' + operation + '成功！</p>',
                '<p class="info_text small_text">本提示栏2秒之后自动关闭！</p>',
                '</div>',
            ].join('');
        }
        else {
            var html = [
                '<div class="tips_text">',
                '<p class="be_sad"><i class="fa fa-smile-o"></i>  ' + operation + '失败！</p>',
                '<div class="fail_mask">',
                '<p>' + info + '</p>',
                '</div>',
                '<p class="info_text small_text">本提示栏3秒之后自动关闭！</p>',
                '</div>',
            ].join('');
        }
        return html;
    }

    // ajax form拦截提交事件
    $('#uploadPicSubmit').click(function () {
        var options = {
            dataType: 'json',
            timeout: 3000,
            success: function (data) {
                var html = build_html(data.status, data.info, data.operation);
                $('.validation_tips_area').html(html).css('display', 'block');
                setTimeout(function () {
                    $('.validation_tips_area').fadeOut('slow');
                }, 2000);
                if (data.status === 1)  //成功
                {
                    var from = "{{$name}}";
                    // parent.$('#' + from).val(data.url);  //回调图片地址到父窗口
                    parent.$("input[name='" + from + "']").val(data.url);
//                    parent.showThumb(data.url);
                    // 添
                    parent.call_back2(data.url);
                    parent.layer.close(index);
                }
                else {
                }
            },
            error: function () {
                var html = build_html(0, '失败：服务器端异常', '操作');
                $('.validation_tips_area').html(html).css('display', 'block');
                setTimeout(function () {
                    $('.validation_tips_area').fadeOut('slow');
                }, 3000);
            }
        };
        $('#uploadPictureForm').ajaxForm(options);
    });
</script>

</body>
</html>