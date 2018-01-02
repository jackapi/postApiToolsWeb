<?php

namespace app\index\model;

use think\Model;

class user_role_link extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'user_role_link';
    protected $insert = ['hash', 'addtime'];
    public $error = "";
    public $token = "";

    protected function setHashAttr() {
        return \app\index\controller\Base::guid();
    }

    protected function setAddTimeAttr() {
        return time();
    }

    

}
