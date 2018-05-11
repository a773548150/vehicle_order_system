<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:39
 */

namespace Home\Model;

class VehicleModel extends BaseModel {

    public function selectLicense() {
        $m = M("vehicle");
        $searchText = I("post.searchText");
        $data['license_plate'] = array('like', '%'.$searchText.'%');
        $result = $m->where($data)->getField("license_plate", true);
        return $result;
    }
}