$(window).ready(function(){
    layui.use('form', function(){
        var form = layui.form;

        //监听提交
        form.on('submit(formDemo)', function(data){
            var datas = data.field;
            var action = data.form.action;
            $.ajax({
                url: "/Admin/Index/login",
                type: 'post',
                dataType: 'json',
                data: datas,
                success: function (data, status) {
                    if (data == "登录成功") {
                        alert(data);
                        window.location = "/Admin/Index/index";
                    } else if (data == "登录失败") {
                        alert("密码或账号错误");
                    }
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
            return false;
        });
    });
});
