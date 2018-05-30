var vm = new Vue({
    el: '#main',
    data: {
        name: '',
        mobile_number: '',
        license_plate: '',
        company: ''
    },
    created: function () {
        var vthis = this;
        $.ajax({
            url: "../Order/searchEditMy",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                for(var i in data) {
                    if(data[i]["order_status"] != '0') {
                        vthis.name = data[i]["name"];
                        vthis.mobile_number = data[i]["mobile_number"];
                        vthis.license_plate = data[i]["driver_license_plate"];
                        vthis.company = data[i]["company"];
                    }
                }
                console.log(data);
            },
            fail: function (err, status) {
                console.log(err)
            }
        });

    },
    computed: {
        now: function () {

        }
    },
    methods: {
        submit: function () {
            var vthis = this;
            if (this.name == "" || this.mobile_number == "" || this.license_plate == "" || this.company == "") {
                alert("输入不能为空");
            } else {
                $.ajax({
                    url: "../Order/alertPersonalMessage",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "name": this.name,
                        "mobile_number": this.mobile_number,
                        "license_plate": this.license_plate,
                        "company": this.company,
                    },
                    success: function (data, status) {
                        alert("修改成功");
                        location.href = "../Index/toMy";
                    },
                    fail: function (err, status) {
                        console.log(err)
                    }
                });
            }
        },
        refresh: function () {
            location.reload();
        }
    }
});