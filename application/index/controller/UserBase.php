<?php

namespace app\index\controller;

/**
 * user继承
 * @author chenran(apizl) <apiziliao@gmail.com> 
 */
class UserBase extends Base {

    public $userData = null;

    public function __construct(\think\Request $request = null) {
        parent::__construct($request);
        $token = $this->request->request('token', '');
        $result = \app\index\model\user_token::get(['token' => $token]);
        if (empty($result)) {
            $this->json('请登录在操作!');
        }
        $this->userData($result->uid);
    }

    /**
     * 用户数据存储
     * @param type $uid
     */
    public function userData($uid) {
        $result = \app\index\model\user::get(['hash' => $uid]);
        if ($result->hash) {
            $this->userData = $result;
            session('userData', $this->userData);
            return;
        }
        $this->userData = null;
        $this->json('不存在的用户！');
    }

}
