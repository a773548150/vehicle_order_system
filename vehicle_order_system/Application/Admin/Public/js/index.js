$(window).ready(function() {
    $("#loginOff").click(function () {
        $.ajax({
            url: "/Admin/Index/loginOff",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                alert(data);
                if (data == "成功退出") {
                    $.cookie("username", "");
                    window.location = "/Admin/Index/toLogin";
                }
            },
            fail: function (err, status) {
                console.log(err)
            }
        });
    });
});