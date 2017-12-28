<?php

namespace app\index\model;

use think\Model;

class user extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'user';
    protected $insert = ['hash', 'addtime'];
    public $error = "";

    protected function setHashAttr() {
        return \app\index\controller\Base::guid();
    }

    protected function setAddTimeAttr() {
        return time();
    }

    public function register() {
        $user = user::get(['name' => $this->data['name']]);
        if ($user) {
            $this->error = "当前用户名已被注册";
            return false;
        }
        $this->data['salt'] = $salt = \app\index\controller\Base::guid();
        $this->data['password'] = md5($this->data['password'] . $salt);
        $this->data['login_ip'] = \app\index\controller\Base::getUserIp() ;
        $this->data['login_time'] = time();
        $this->data['add_time'] = time();
        $this->data['role'] = 0;
        $this->data['state'] = 1;
        return $this->save();
    }

}
