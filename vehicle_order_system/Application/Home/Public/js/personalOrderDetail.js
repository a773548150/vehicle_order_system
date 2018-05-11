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
            $.ajax({
                url: "/Home/Order/makeServiceOrder",
                type: 'post',
                dataType: 'json',
                data: datas,
                success: function (data, status) {
                    alert("填写送达订单成功");
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