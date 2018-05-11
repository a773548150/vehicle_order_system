$(window).ready(function() {
    layui.use('element', function () {
        var element = layui.element;

        //…
    });

    $.ajax({
        url: "/Home/Order/showFinishOrderDetail",
        type: 'post',
        dataType: 'json',
        success: function (data, status) {
            console.log(data);
        },
        fail: function (err, status) {
            console.log(err)
        }
    });

});