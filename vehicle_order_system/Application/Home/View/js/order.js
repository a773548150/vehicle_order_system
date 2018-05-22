var vm = new Vue({
    el: '#main',
    data: {
        selected: '油品类',
        selectOilNameData: '',
        selects: [
            {value: '油品类'},
            {value: '化工类'},
            {value: '合成类'}
        ],
        chepai: '',
        oilName: [],
        license_plate : '',
        company: '',
        isStop: true,
        mobile_number : '',
        name: ''
    },
    created: function () {
        var vthis = this;
        $.ajax({
            url: "../Oil/searchOil",
            type: 'post',
            dataType: 'json',
            data: {"type" : this.selected},
            success: function (data, status) {
                vthis.oilName = data;
                vthis.selectOilNameData = data[0];
                console.log(vthis.selectOilNameData);
            },
            fail: function (err, status) {
                console.log(err)
            }
        });

        $.ajax({
            url: "../Order/defaultInput",
            type: 'post',
            dataType: 'json',
            success: function (data, status) {
                vthis.license_plate = data[0]["license_plate"].substring(1, data[0]["license_plate"].length);
                vthis.company = data[0]["company"];
                if(data[0]["stop"] == 1) {
                    vthis.isStop = false;
                } else {
                    vthis.isStop = true;
                }
                console.log(vthis.license_plate);
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
        selectVal: function (ele) {
            this.selected = ele.target.value;
            var vthis = this;
            $.ajax({
                url: "../Oil/searchOil",
                type: 'post',
                dataType: 'json',
                data: {"type": this.selected},
                success: function (data, status) {
                    vthis.oilName = data;
                    vthis.selectOilNameData = data[0];
                    console.log(vthis.oilName);
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
        },
        selectOilName: function (ele) {
            this.selectOilNameData = ele.target.value;
            console.log(this.selectOilNameData);
        },
        submit: function () {
            var vthis = this;
            if (this.license_plate == "" || this.company == "") {
                alert("输入不能为空");
            } else if (this.license_plate.length != 5) {
                alert("车牌号必须要五位");
            } else {
                $.ajax({
                    url: "../Order/makeOrder",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "OilName": this.selectOilNameData,
                        "license_plate": this.license_plate
                    },
                    success: function (data, status) {
                        alert("预约成功");
                    },
                    fail: function (err, status) {
                        console.log(err)
                    }
                });
                $.ajax({
                    url: "../Driver/addDriver",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "name": this.name,
                        "mobile_number": this.license_plate,
                        "company": this.company
                    },
                    success: function (data, status) {
                        console.log("添加司机信息成功");
                    },
                    fail: function (err, status) {
                        console.log(err)
                    }
                })
            }
        }
    }
});