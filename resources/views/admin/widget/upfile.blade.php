<!-- <script type="text/javascript" src="{!!asset('js/jquery-2.1.1.min.js')!!}"></script> -->
<script type="text/javascript" src="{!!asset('js/plugins/layer/1.8.5/layer.min.js')!!}"></script>

<script type="text/javascript">
    $('.uploadPic').click(function () {
        var ele = $(this).data('id');
        $.layer({
            type: 2,
            shade: [0.5, '#000', true],
            border: [0],
            title: false,
            closeBtn: false,
            shadeClose: true,
            fix: false,
            iframe: {src: '{{ url('admin/upload') }}?from=' + ele},
            area: ['600px', '250px'],
            offset: ['', ''],
            success: function (layero) {
                $(layero['selector'] + ' .xubox_main').css('border-radius', '6px');
                $(layero['selector'] + ' .xubox_iframe').css('border-radius', '6px');
            },
            close: function (index) {
                layer.closeAll();
            },
            end: function (index) {
                //location.reload();
            }
        });
    });
    $('.previewPic').hover(function () {
        var ele = $(this).data('id');
        var pic_url = $.trim($("input[name='" + ele + "']").val());
        if (pic_url == '') {
            return;
        }

        tmp = '<div style="max-width: 300px;"><img src="' + pic_url + '" width="300" /></div>';
        $('#layerPreviewPic').html(tmp);
        $.layer({
            type: 1,
            title: false,
            fix: false,
            skin: 'layui-layer-demo', //样式类名
            shadeClose: true, //开启遮罩关闭
            closeBtn: 1, //不显示关闭按钮
            border: [0],
//							shade: [0],
            offset: ['50px', ''],
            area: ['300px', 'auto'],
            page: {dom: '#layerPreviewPic'}
        });


    }, function () {

    });

</script>