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
        oilName: [],
        loading: '',
        factoryArea: '',
        factoryOut: [],
        isStop: false,
        searchData: ''
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
                vthis.selectOilNameData = 0;
                //console.log(vthis.selectOilNameData);
                var ele = { target:{ value : vthis.selectOilNameData}};
                vthis.selectOilName(ele);
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
                    var ele = { target:{ value : vthis.selectOilNameData}};
                    vthis.selectOilName(ele);
                   // console.log(vthis.oilName);
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
        },
        selectOilName: function (ele) {
            this.selectOilNameData = ele.target.value;
            var vthis = this;
            $.ajax({
                url: "../Order/searchLicense",
                type: 'post',
                dataType: 'json',
                data: {"oilName": this.selectOilNameData},
                success: function (data, status) {
                    // vthis.loading
                    vthis.loading = '';
                    vthis.factoryArea = '';
                    vthis.factoryOut = [];
                    for(var i in data) {
                        for(var j in data[i]) {
                            if(j == "order_status" && data[i][j] == 0){
                                console.log(data[i][j]);
                            } else if(j == "order_status" && data[i][j] == 1) {
                                vthis.loading = data[i]["license_plate"];
                                console.log(vthis.loading);
                            } else if(j == "order_status" && data[i][j] == 2) {
                                vthis.factoryArea = data[i]["license_plate"];
                                console.log(vthis.factoryArea);
                            } else if(j == "order_status" && data[i][j] == 3) {
                                vthis.factoryOut.push([data[i]["license_plate"], data[i]["rank"]]);
                                console.log(vthis.factoryOut);
                            }
                        }
                        if (data[i]["stop"] == 1){
                            vthis.isStop = true;
                        }
                    }
                },
                fail: function (err, status) {
                    console.log(err)
                }
            });
            //console.log(this.selectOilNameData);
        },
        submit: function () {
            var vthis = this;
            if (this.searchData == "") {
                alert("输入不能为空");
            } else {
                $.ajax({
                    url: "../Order/searchData",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "searchData": this.searchData
                    },
                    success: function (data, status) {
                        vthis.loading = '';
                        vthis.factoryArea = '';
                        vthis.factoryOut = [];
                        if (data[0] == 0) {
                            alert("车牌号错误");
                        } else if(data[0]["order_status"] == 1) {
                            vthis.loading = data[0]["license_plate"];
                        } else if(data[0]["order_status"] == 2) {
                            vthis.factoryArea = data[0]["license_plate"];
                            console.log(vthis.factoryArea);
                        } else if(data[0]["order_status"] == 3) {
                            vthis.factoryOut.push([data[0]["license_plate"], data[0]["rank"]]);
                            console.log(vthis.factoryOut);
                        }
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