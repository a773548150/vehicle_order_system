var vm = new Vue({
    el: '#main',
    data: {
        message: [],
        license_plate: '',
        order_status: '',
        company: '',
        name: '',
        mobile_number: '',
        create_time: '',
        type: '',
        isIng: false,
        isCq: false,
        isFinish: false
    },
    created: function () {
        var vthis = this;
        $.ajax({
            url: "/Home/Order/searchPersonalOrder",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                for(var i in data){
                    if(data[i]["order_status"] == 0) {
                        data[i]["order_status"] = "已装";
                        vthis.isIng = false;
                        vthis.isCq = false;
                        vthis.isFinish = true;
                    } else if(data[i]["order_status"] == 1) {
                        data[i]["order_status"] = "装车中";
                        vthis.isIng = true;
                        vthis.isCq = false;
                        vthis.isFinish = false;
                    } else if(data[i]["order_status"] == 2) {
                        data[i]["order_status"] = "厂区内待装";
                        vthis.isIng = false;
                        vthis.isCq = true;
                        vthis.isFinish = false;
                    } else if(data[i]["order_status"] == 3) {
                        data[i]["order_status"] = "厂外待装";
                        vthis.isIng = false;
                        vthis.isCq = false;
                        vthis.isFinish = false;
                    }

                    vthis.message.push({
                        license_plate: data[i]["t_order_license_plate"],
                        order_status: data[i]["order_status"],
                        company: data[i]["company"],
                        name: data[i]["name"],
                        mobile_number: data[i]["mobile_number"],
                        create_time: data[i]["create_time"],
                        type: data[i]["type"],
                        isIng : vthis.isIng,
                        isCq : vthis.isCq,
                        isFinish : vthis.isFinish
                    });
                }
                console.log(vthis.message);
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