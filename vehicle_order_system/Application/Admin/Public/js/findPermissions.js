$(window).ready(function() {
    $.ajax({
        url: "/Admin/Role/findPermissions",
        type: 'post',
        dataType: 'json',
        success: function (data, status) {
            console.log("查询成功");
        },
        fail: function (err, status) {
            console.log(err)
        }
    });
});