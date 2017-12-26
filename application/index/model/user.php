<?php

namespace app\index\model;

use think\Model;

class user extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'user';
    protected $insert = ['hash', 'addtime'];

    protected function setHashAttr() {
        return \app\index\controller\Base::guid();
    }

    protected function setAddtimeAttr() {
        return time();
    }

}
