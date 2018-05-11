$(window).ready(function (){
    layui.use('form', function(){
        var form = layui.form;

        //监听提交
        form.on('submit(formDemo)', function(data){
            var datas = data.field;
            if (datas.newPassword == datas.newPassword2) {
                $.ajax({
                    url: "alertPassword",
                    type: 'post',
                    dataType: 'json',
                    data: datas,
                    success: function (data, status) {
                        if (data == 1) {
                            $.cookie("username", "");
                            alert("修改密码成功");
                            window.location = "/Admin/Index/toLogin";
                        } else if (data == 2) {
                            alert("密码错误");
                        }
                    },
                    fail: function (err, status) {
                        console.log(err)
                    }
                });
            } else {
                alert("密码不一致");
            }
            return false;
        });

    });

//     $(".inputNewPsswordHide").hide();
//     $("#eye").click(function(){
//         if ($(".inputNewPssword").attr("id") != "") {
//             $(".inputNewPssword").hide();
//             $(".inputNewPssword").attr("id", "");
//             $(".inputNewPsswordHide").show();
//             $(".inputNewPsswordHide").attr("id", "inputNewPssword");
//             $(".inputNewPsswordHide").val($(".inputNewPssword").val());
//         } else {
//             $(".inputNewPsswordHide").hide();
//             $(".inputNewPsswordHide").attr("id", "");
//             $(".inputNewPssword").show();
//             $(".inputNewPssword").attr("id", "inputNewPssword");
//             $(".inputNewPssword").val($(".inputNewPsswordHide").val());
//         }
//     });
});