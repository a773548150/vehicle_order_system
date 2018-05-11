$(window).ready(function() {
    layui.use('element', function () {
        var element = layui.element;

        //…
    });

    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#test1', //指定元素
            format: 'yyyy-MM-dd HH:mm',
            type: 'datetime'
        });
    });

    layui.use('form', function(){
        var form = layui.form;

        //监听提交
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data) {
            var datas = data.field;
            $.ajax({
                url: "/Home/Order/makeOrder",
                type: 'post',
                dataType: 'json',
                data: datas,
                success: function (data, status) {
                    alert("领取订单成功");
                    // window.location = "/Admin/Index/toOrder";
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
            return false;
        });
    });

    $("#search-license").bind('keyup', function(){
        var searchText = $('#search-license').val();
        $.ajax({
            url: "/Home/Vehicle/selectLicense",
            type: 'post',
            data: {searchText : searchText},
            dataType: 'json',
            success: function (data, status) {
                var html = '';
                for(var i=0; i<data.length; i++){
                    html+='<li>'+data[i]+'</li>';
                }
                $('#search-result').html(html);
                $('#search-suggest').show().css({
                    position:'absolute',
                    left: $('.layui-form').offset().left,
                    top:$('.layui-form').offset().top-70
                })
            },
            fail: function (err, status) {
                console.log(err)
            }
        });
    });

    $(document).bind('click', function(){
        $('#search-suggest').hide();
    });

    $(document).delegate('li','click',function () {
        var val = $(this).text();
        $('#search-license').val(val);
    });

});