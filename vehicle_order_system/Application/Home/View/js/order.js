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
        license_plate: '',
        company: '',
        isStop: true,
        mobile_number: '',
        name: '',
        citys: ['京', '津', '冀', '晋', '蒙', '辽', '吉', '黑', '沪', '苏', '浙', '皖', '闽', '赣', '鲁', '豫', '鄂', '湘', '粤', '桂', '琼', '渝', '川', '黔', '滇', '藏', '陕', '甘', '青', '宁', '新', '台', '港', '澳'],
        cityWords: ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','X','T','U','V','W','X','Y','Z'],
        nowCity: '',
        nowCityWords: ''
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
                vthis.license_plate = data[0]["license_plate"].substring(2, data[0]["license_plate"].length);
                vthis.nowCity = data[0]["license_plate"].substring(0, 1);
                vthis.nowCityWords = data[0]["license_plate"].substring(1, 2);
                console.log("nowCity:"+ vthis.nowCity + "nowCityWords:" + vthis.nowCityWords);
                vthis.company = data[0]["company"];
                vthis.name = data[0]["name"];
                vthis.mobile_number = data[0]["mobile_number"];
                if(data[0]["stop"] == 1 ) {
                    vthis.isStop = false;
                    alert("目前暂停中");
                } else if(data[0]["order_status"] == 3){
                    vthis.isStop = false;
                    alert("预约进行中");
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
            if (this.mobile_number == "" || this.name == "" || this.license_plate == "" || this.company == "") {
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
                        "license_plate": this.nowCity + this.nowCityWords + this.license_plate,
                        "company": this.company
                    },
                    success: function (data, status) {
                        if(data == "0"){
                            alert("目前暂停中");
                            location.reload();
                        }else{
                            alert("预约成功");
                            location.reload();
                        }
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
                        "mobile_number": this.mobile_number,
                        "license_plate": this.nowCity + this.nowCityWords + this.license_plate,
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