$(window).ready(function() {
    layui.use('element', function () {
        var element = layui.element;

        //…
    });

    $.ajax({
        url: "/Home/Order/selectUnTaking",
        type: 'post',
        dataType: 'json',
        success: function (data, status) {
            console.log(data);
        },
        fail: function (err, status) {
            console.log(err)
        }
    });



    $(".unTakingAll .tableAll").click(function() {
        var id = $(this).attr("id");
        window.location = "/Home/Index/toOrderDetail?id=" + id;
    });
});