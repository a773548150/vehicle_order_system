<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Admin\Model;

class NoticeModel extends BaseModel {

    public function addNotice() {
        $m = M("notice");
        $L = A("Log");

        $data['title'] = I('post.title');
        $data['content'] = I('post.content');
        $data['create_time'] = date("Y-m-d h:i:s");
        $result = $m->data($data)->add();
        $L->insert("添加了标题为：'".$data['title']."'的公告");
        return $result;
    }

    public function searchNotice() {
        $m = M("Notice");
        $page = I('get.page');
        $limit = I('get.limit');
        $data['title'] = array('LIKE', "%".I('get.title')."%");
        $data["status"] = 1;
        $result = $m->where($data)->order('id desc')->page($page, $limit)->select();

        return $result;
    }

    public function deleteNotice() {
        $m = M("Notice");
        $L = A("Log");
        $title = I("post.title");
        $L->insert("删除了标题为：'".$title."'的公告");
        $m->delete(I('post.id'));
        echo "1";
    }

    public function editNotice() {
        $m = M("notice");
        $L = A("Log");
        $lim["id"] = I('post.id');
        $data = I('post.value');

        $data['update_time'] = date("Y-m-d h:i:s");
        $res = $m->where($lim)->save($data);
        $title = $m->where(array("id" => $lim["id"]))->getField("title");
        $L->update("修改公告标题：“".$title."”的信息");
        return $res;
    }

}