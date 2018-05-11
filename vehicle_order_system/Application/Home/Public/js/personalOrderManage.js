$(window).ready(function() {
    layui.use('element', function () {
        var element = layui.element;

        //…
    });

    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#time1', //指定元素
            format: 'yyyy-MM',
            type: 'datetime'
        });
    });

    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#time2', //指定元素
            format: 'yyyy-MM',
            type: 'datetime'
        });
    });

    layui.use('form', function () {
        var form = layui.form;
        form.on('submit(timeSelect)', function (data) {
            var datas = data.field;
            var url = "/Home/Index/toPersonalOrderManage?" + "&startTime=" + datas.startTime + "&endTime=" + datas.endTime;
            window.location = url;
            return false;
        });
    });


    // $.ajax({
    //     url: "/Home/Order/selectPersonalUnFinish",
    //     type: 'post',
    //     dataType: 'json',
    //     success: function (data, status) {
    //         console.log(data);
    //     },
    //     fail: function (err, status) {
    //         console.log(err)
    //     }
    // });
    //
    // $.ajax({
    //     url: "/Home/Order/selectFinish",
    //     type: 'post',
    //     dataType: 'json',
    //     success: function (data, status) {
    //         console.log(data);
    //     },
    //     fail: function (err, status) {
    //         console.log(err)
    //     }
    // });

    $(".unFinishAll .tableAll").click(function() {
        var id = $(this).attr("id");
        window.location = "/Home/Index/toPersonalOrderDetail?id=" + id;
    });

    $(".finishAll .tableAll").click(function() {
        var id = $(this).attr("id");
        window.location = "/Home/Index/toFinishOrderDetail?id=" + id;
    });
});