$(window).ready(function() {
    //全局变量
    var url = "/Admin/Vehicle/searchVehicle";
    var editData = "";

    layui.use('element', function () {
        var element = layui.element;
        //一些事件监听
        element.on('tab(demo)', function (data) {
            console.log(data);
        });
    });

    layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data){
            var datas = data.field;
            datas.roleName = $("#addRoleNameSelect option:selected").text();
            $.ajax({
                url: "/Admin/Role/addUser",
                type: 'post',
                dataType: 'json',
                data: datas,
                success: function (data, status) {
                    alert("添加成功");
                    window.location = "/Admin/Index/toUser";
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
            return false;
        });


        form.on('submit(permissions)', function(data){
            var datas = data.field;
            datas.username = $("#usernameSelect option:selected").text();
            datas.roleName = $("#roleNameSelect option:selected").text();
            $.ajax({
                url: "/Admin/Role/addPermissions",
                type: 'post',
                dataType: 'json',
                data: datas,
                success: function (data, status) {
                    alert("修改成功");
                    window.location = "/Admin/Index/toUser";
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
            ,width: 525
            ,height: 354
            ,limit: 8
            ,url: '/Admin/Role/searchUser' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'username', title: '用户名', width:185, sort: true, fixed: 'left'}
                ,{field: 'role_name', title: '角色名', width:185, sort: true, fixed: 'left'}
                ,{fixed: 'right', width:150, align:'center', toolbar: '#barDemo'}
            ]]
        });

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
                        url: "/Admin/Vehicle/deleteVehicle",
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
        table.on('edit(test)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
            console.log(obj.value); //得到修改后的值
            console.log(obj.field); //当前编辑的字段名
            console.log(obj.data); //所在行的所有相关数据
            editData = obj;
        });
    });

});