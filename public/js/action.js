var url = $("#action").data('url');
console.log(url);

//删除
$(".trash").on('click', function () {
    var id = $(this).data('id');
    var ele = $(this);
    console.log(id);
    layer.confirm('确认删除? 不要后悔哦!', {
        btn: ['确定', '取消'],
        closeBtn: 0
    }, function () {
        console.log('ok');
        $.ajax({
            url:url+"/"+id,
            type:'DELETE',
            data:{},
            success:function(data){
                console.log(data);
                if(data.status == 0){
                    layer.msg('操作完成');
                    console.log(ele.parent().parent().remove() );
                }
            },
            error:function(data){
                //
                console.log(data);
                layer.msg('操作失败,请联系管理员');
            }
        });

    }, function () {
    });
});

//重置密码
$(".re-key").on('click', function () {
    var id = $(this).data('id');
    console.log(id);
    layer.confirm('密码重置为: W123456w', {
        btn: ['确定', '取消'],
        closeBtn: 0
    }, function () {
        console.log('ok');
        $.get(url + '/' + id, {type:'changePassword'}, function(data){
            if(data.status == 0){
                layer.msg('操作完成');
            }else{
                layer.msg('操作失败，请联系管理员');
            }
        });

    }, function () {
    });
});

//改变状态
$(".status").on('click', function () {
    var s = $(this);
    var id = s.data('id');
    var status = s.data('status');
    var type = s.data('type');


    console.log(id);
    $.get(url + '/' + id, {type: type, status: status}, function (data) {
        console.log(data);
        if (data.status == 0) {
            //
            if (s.hasClass('fa-check')) {
                s.removeClass('fa-check').removeClass('text-success');
                s.addClass('fa-ban').addClass('text-danger');
                s.data('status', 1)
            } else {
                s.removeClass('fa-ban').removeClass('text-danger');
                s.addClass('fa-check').addClass('text-success');
                s.data('status', 0)
            }
            layer.msg("操作完成");
            console.log('done');
        } else {
            layer.msg("操作失败,请联系管理员");
            console.log('error');
        }
    });

});