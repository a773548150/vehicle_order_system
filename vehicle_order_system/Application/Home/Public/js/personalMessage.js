$(window).ready(function() {
    layui.use('element', function () {
        var element = layui.element;

        //…
    });

    layui.use('form', function(){
        var form = layui.form;

        //监听提交
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data) {
            var datas = data.field;
            var fd = new FormData();
            fd.append("upLoad", 1);
            fd.append("upFile", $("#file").get(0).files[0]);
            console.log(fd);
            $.ajax({
                url: "/Home/Driver/uploadProfilePhoto",
                type: 'post',
                data: fd,
                processData: false,
                contentType: false,
                success: function (data, status) {
                    alert("上传头像成功");
                    // window.location = "/Admin/Index/toOrder";
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
            return false;
        });
    });

});