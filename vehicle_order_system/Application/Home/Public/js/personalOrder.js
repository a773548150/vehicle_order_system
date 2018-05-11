$(window).ready(function() {
    layui.use('element', function () {
        var element = layui.element;

        //…
    });



    $.ajax({
        url: "/Home/Order/selectPersonalUnFinish",
        type: 'post',
        dataType: 'json',
        success: function (data, status) {
            console.log(data);
        },
        fail: function (err, status) {
            console.log(err)
        }
    });


    $(".tableAll").click(function() {
        var id = $(this).attr("id");
        window.location = "/Home/Index/toPersonalOrderDetail?id=" + id;
    });
});