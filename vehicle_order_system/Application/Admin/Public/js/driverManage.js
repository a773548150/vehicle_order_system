//获取url参数
(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
})(jQuery);

$(window).ready(function() {
    //全局变量
    var editData = "";
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
        }

        //监听提交
        form.on('submit(formSearch)', function (data) {
            var datas = data.field;
            var url = "../Driver/searchDriver?number=" + datas.number;
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

    });

    layui.use('table', function(){
        var table = layui.table;
        //第一个实例
        table.render({
            elem: '#order'
            ,height: 515
            ,width: 726
            ,limit: 11
            ,url: '../driver/searchDriver' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'headimgurl', title: '微信头像', width:100, sort: true}
                ,{field: 'nickname', title: '微信昵称', width:190, sort: true}
                ,{field: 'name', title: '真实姓名', width:160}
                ,{field: 'mobile_number', title: '手机号码', width:120, sort: true}
                ,{field: 'company', title: '隶属公司名', width: 150, sort: true}
            ]]
            ,done: function(res, curr, count) {
                console.log(res);
                var a = [];
                // for(var x=0; x<$("tr[data-index]").length; x++) {
                //     a[x] = $("tr[data-index]")[x].getElementsByTagName('td')[0].innerText;
                // }
                //
                // $("td[data-field='headimgurl']").html("<img src=''/>");
                // console.log($("tr[data-index]"));
                // for(var x=0; x<$("tr[data-index]").length; x++) {
                //     $("td[data-field='headimgurl'] img")[x].setAttribute("src", a[x]);
                // }


                //$("td[data-field='headimgurl'] img").attr("src", $("td[data-field='headimgurl']").text());
            }
        });
        //绑定删除和编辑按钮
        table.on('tool(test)', function(obj){//注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
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
                        url: "../Driver/deleteDriver",
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
            } else if(layEvent === 'edit'){ //编辑
                //do something
                if(editData != ""){
                    if(editData.data.id === data.id) {
                        alert(editData.data.number);

                        $.ajax({
                            url: "../Driver/editDriver",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                "field" : editData.field,
                                "value" : editData.data,
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
});