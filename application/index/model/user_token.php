<?php

namespace app\index\model;

use think\Model;

class user_token extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'user_token';
    public $error = "";

    /**
     * 创建登录token
     * @param type $uid
     * @return type
     */
    public function addToken($uid) {
        $userToken = new user_token();
        $token = \app\index\controller\Base::guid();
        $data = [
            'uid' => $uid,
            'token' => $token,
            'add_time' => time(),
            'end_time' => time() + ( 24 * 3600 * 30),
            'login_ip' => \app\index\controller\Base::getUserIp(),
            'code' => \app\index\controller\Base::guid(),
        ];
        return $userToken->save($data);
    }

}
