$(window).ready(function(){

    layui.use('element', function(){
        var element = layui.element;
        //一些事件监听
        element.on('tab(demo)', function(data){
            console.log(data);
        });
    });

    layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data){
            var datas = data.field;
            $.ajax({
                url: "/Admin/Order/makeOrder",
                type: 'post',
                dataType: 'json',
                data: datas,
                success: function (data, status) {
                    alert("添加成功");
                    window.location = "/Admin/Index/toOrder";
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
            return false;
        });
    });

    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#test1', //指定元素
            format: 'yyyy-MM-dd HH:mm',
            type: 'datetime'
        });
    });


    // $("#submit").click(function(){
    //     var datas = {};
    //     datas.destination = $("#destination").val();
    //     datas.number = $("#number").val();
    //     datas.startTime = $("#test1").val();
    //     datas.goodsName = $("#selectGoods option:selected").text();
    //     console.log(datas);
    //
    // });
});
