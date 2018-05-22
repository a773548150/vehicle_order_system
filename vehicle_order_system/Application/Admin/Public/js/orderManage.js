//获取url参数
(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
})(jQuery);

$(window).ready(function() {

    $(".rank").hide();
    //全局变量
    var editData = "";
    var selectDatas = {};
    selectDatas.missionStatus = 3;

    layui.use('element', function () {
        var element = layui.element;
        //一些事件监听
        element.on('tab(demo)', function (data) {
            console.log(data);
        });
    });

    layui.use('form', function () {
        var form = layui.form;
        form.render();
        var  missionStatus = $.getUrlParam('missionStatus');
        if (missionStatus==="1") {
            $("select[name=orderStatus]").val("1");
            form.render('select');
        } else if (missionStatus==="0") {
            $("select[name=orderStatus]").val("0");
            form.render('select');
        } else if (missionStatus==="2") {
            $("select[name=orderStatus]").val("2");
            form.render('select');
        } else if (missionStatus==="3") {
            $("select[name=orderStatus]").val("3");
            form.render('select');
        }

        form.on('select(status)', function(data){
            //console.log(data.elem); //得到select原始DOM对象
            console.log(data.value); //得到被选中的值
            //console.log(data.othis); //得到美化后的DOM对象
            if (data.value == 3) {
                $(".rank").show();
            } else {
                $(".rank").hide();
                $("#inputRank").val(0);
            }
        });

        //监听提交
        form.on('submit(formSearch)', function (data) {
            var datas = data.field;
            var url = "../Order/searchOrder?missionStatus=3&number=" + datas.number;
            layui.use('table', function() {
                var table = layui.table;
                table.reload('order', {
                    url: url
                });
            });
            return false;
        });

        form.on('select(selectStatus)', function(data){
            selectDatas.missionStatus = data.value;

            var url = "../Order/searchOrder?missionStatus=" + selectDatas.missionStatus;
            layui.use('table', function() {
                var table = layui.table;
                table.reload('order', {
                    url: url
                });
            });
            return false;
        });

        form.on('select(selectOil)', function(data){

            return false;
        });

        form.on('submit(formDemo)', function(data){
            var datas = data.field;
            datas.oil = $("#selectOil option:selected").text();
            datas.vehicle = $("#selectVehicle option:selected").text();
            datas.status = $("#addStatusSelect option:selected").val();
            $.ajax({
                url: "../Order/makeOrder",
                type: 'post',
                dataType: 'json',
                data: datas,
                success: function (data, status) {
                    alert("添加成功");
                    window.location = "../Index/toOrderManage";
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
            return false;
        });

    });

    layui.use('table', function(){
        var table = layui.table;
        //第一个实例
        table.render({
            elem: '#order'
            ,height: 515
            ,width: 1400
            ,limit: 11
            ,url: '../Order/searchOrder' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'stop', title: '排队状态', width:120, sort: true}
                ,{field: 'number', title: '单号', width:190, sort: true}
                ,{field: 'driver_mobile_number', title: '司机手机号', width:190, sort: true}
                ,{field: 'order_status', title: '状态', width: 160, sort: true}
                ,{field: 'rank', title: '排队名次', width:160, sort: true}
                ,{field: 'oil_name', title: '油名', width:160}
                ,{field: 'create_time', title: '开始时间', width:160}
                ,{fixed: 'right', width:150, align:'center', toolbar: '#barDemo'}
            ]]
        });

        //绑定删除和编辑按钮
        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象

            if(layEvent === 'del'){ //删除
                console.log(data);
                layer.confirm('真的删除行么', function(index){
                    obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                    layer.close(index);
                    //向服务端发送删除指令
                    $.ajax({
                        url: "../Order/deleteOrder",
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        success: function (datas, status) {
                            if(datas == "0"){
                                alert("不允许删除后三位和非厂外待装");
                                location.reload();
                            } else {
                                alert("删除成功");
                                location.reload();
                            }
                        },
                        fail: function (err, status) {
                            console.log(err)
                        }
                    });
                });
            } else if(layEvent === 'edit'){ //编辑
                //do something
                if(editData != ""){
                    if(editData.data.id === data.id) {
                        if(editData.data.order_status == "厂外待装") {
                            $.ajax({
                                url: "../Order/editOrder",
                                type: 'post',
                                dataType: 'json',
                                data: {
                                    "field" : editData.field,
                                    "value" : editData.value,
                                    "id"    : editData.data.id
                                },
                                success: function (data, status) {
                                    alert("修改成功");
                                    console.log(data);
                                },
                                fail: function (err, status) {
                                    console.log(err)
                                }
                            });
                        } else {
                            alert("不允许非厂外待装排队名次进行修改");
                            location.reload();
                        }

                    }
                }

            }
        });
        table.on('edit(test)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
            console.log(obj.value); //得到修改后的值
            console.log(obj.field); //当前编辑的字段名
            console.log(obj.data); //所在行的所有相关数据
            editData = obj;
        });

    });

    $("#excel").click(function () {
        var startTime = $("input[name='startTime']").val();
        var endTime = $("input[name='endTime']").val();

        window.location = "../Order/expUser?missionStatus=" + selectDatas.missionStatus +"&orderNumber=" + selectDatas.number +"&startTime=" + startTime + "&endTime=" + endTime;
    });

    $("#stopRank").click(function () {
        $.ajax({
            url: "../Order/stop",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                alert("暂停排队成功");
                console.log(data);
            },
            fail: function (err, status) {
                console.log(err)
            }
        });
    });
    $("#startRank").click(function () {
        $.ajax({
            url: "../Order/start",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                alert("开始排队成功");
                console.log(data);
            },
            fail: function (err, status) {
                console.log(err)
            }
        });
    });

    $("#forword").click(function () {
        $.ajax({
            url: "../Order/forword",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                alert("排队前进一位");
                location.reload();
            },
            fail: function (err, status) {
                console.log(err)
            }
        });
    });
});
