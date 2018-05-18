$(window).ready(function() {
    $("#loginOff").click(function () {
        $.ajax({
            url: "../Index/loginOff",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                alert(data);
                if (data == "成功退出") {
                    $.cookie("username", "");
                    window.location = "../Index/toLogin";
                }
            },
            fail: function (err, status) {
                console.log(err)
            }
        });
    });
});