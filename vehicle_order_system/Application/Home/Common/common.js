$(window).ready(function (){
    $("#loginOff").click(function () {
        var username = $.cookie("username");
        $.ajax({
            url: "/Home/Index/loginOff",
            type: 'post',
            dataType: 'json',
            data: username,
            success: function (data, status) {
                alert(data);
                if (data == "成功退出") {
                    $.cookie("username", "", { path: "/"}, {expires:-1});
                    $.cookie("head", "", { path: "/"}, {expires:-1});
                    window.location = "/Home/Index/toLogin";
                }
            },
            fail: function (err, status) {
                console.log(err)
            }
        });
    });

    $(".layui-nav-img").attr("src", $.cookie('head'));
});