<?php

namespace app\index\model;

use think\Model;

class user_role extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'user_role';
    protected $insert = ['hash', 'addtime'];
    public $error = "";
    public $token = "";

    protected function setHashAttr() {
        return \app\index\controller\Base::guid();
    }

    protected function setAddTimeAttr() {
        return time();
    }

    /**
     * 添加权限 
     * @author chenran(apizl) <apiziliao@gmail.com>
     * @param type $uid
     * @return boolean
     */
    public function addRole($uid) {
        $user = new user();
        if (!$user->getUserHash($uid)) {
            $this->error = "当前用户不存在";
            return false;
        }
        if (empty($this->data['name'])) {
            $this->error = "权限名不能为空";
            return false;
        }
        $this->uid = $uid;
        $this->addtime = time();
        $this->edit_time = time();
        $result = $this->save();
        if ($result) {
            return true;
        }
        $this->error = "添加失败 ：" . $this->getError();
        return false;
    }

}
