(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
})(jQuery);

$(window).ready(function() {
    var startTime;
    var endTime;

    layui.use('element', function () {
        var element = layui.element;
        //一些事件监听
        element.on('tab(demo)', function (data) {
            console.log(data);
        });
    });

    layui.use('form', function () {
        var form = layui.form;

        //监听提交
        form.on('submit(formSearch)', function (data) {
            var datas = data.field;
            startTime = datas.startTime;
            endTime = datas.endTime;
            var url = "/Admin/Log/searchLog?" + "startTime=" + startTime + "&endTime=" + endTime;
            layui.use('table', function() {
                var table = layui.table;
                table.reload('log', {
                    url: url
                });
            });
            return false;
        });
    });

    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#time1', //指定元素
            format: 'yyyy-MM-dd HH:mm',
            type: 'datetime'
        });
    });

    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#time2', //指定元素
            format: 'yyyy-MM-dd HH:mm',
            type: 'datetime'
        });
    });

    layui.use('table', function(){
        var table = layui.table;
        //第一个实例
        table.render({
            elem: '#log'
            ,height: 600
            ,limit: 11
            ,url: '/Admin/Log/searchLog' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'username', title: '操作者', width:190, sort: true, fixed: 'left'}
                ,{field: 'log', title: '修改内容', width:400, edit: "text"}
                ,{field: 'create_time', title: '修改时间', width:200, edit: "text"}
                ,{fixed: 'right', width:150, align:'center', toolbar: '#barDemo'}
            ]]
        });
    });

    layui.use('table', function() {
        var table = layui.table;
        table.on('tool(test)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象

            if (layEvent === 'del') { //删除
                console.log(data);
                layer.confirm('真的删除行么', function (index) {
                    obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                    layer.close(index);
                    //向服务端发送删除指令
                    $.ajax({
                        url: "/Admin/Log/deleteLog",
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        success: function (data, status) {
                            alert("删除成功");
                            console.log(data);
                        },
                        fail: function (err, status) {
                            console.log(err)
                        }
                    });
                });
            }
        });
    });

});