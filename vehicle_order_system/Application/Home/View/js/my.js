var vm = new Vue({
    el: '#main',
    data: {
        license_plate: '',
        order_status: '',
        company: '',
        name: '',
        mobile_number: '',
        headimgurl: '',
        nickname: '',
        isIng: false,
        isCq: false
    },
    created: function () {
        var vthis = this;
        $.ajax({
            url: "/Home/Order/searchPersonalMessage",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                vthis.license_plate = data[0]["license_plate"];
                if(data[0]["order_status"] == 0) {
                    vthis.order_status = "已装";
                } else if(data[0]["order_status"] == 1) {
                    vthis.order_status = "装车中";
                    vthis.isIng = true;
                    vthis.isCq = false;
                } else if(data[0]["order_status"] == 2) {
                    vthis.order_status = "厂区内待装";
                    vthis.isIng = false;
                    vthis.isCq = true;
                } else if(data[0]["order_status"] == 3) {
                    vthis.order_status = "厂外待装";
                    vthis.isIng = false;
                    vthis.isCq = false;
                }
                vthis.company = data[0]["company"];
                vthis.name = data[0]["name"];
                vthis.mobile_number = data[0]["mobile_number"];
                vthis.headimgurl = data[0]["headimgurl"];
                vthis.nickname = data[0]["nickname"];
            },
            fail: function (err, status) {
                console.log(err)
            }
        });

    },
    methods: {
        refresh: function () {
            location.reload();
        }
    }
});