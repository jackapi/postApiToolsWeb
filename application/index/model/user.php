<?php

namespace app\index\model;

use think\Model;

class user extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'user';
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
     * 判断用户是否存在  返回对象
     * @author chenran(apizl) <apiziliao@gmail.com>
     * @param type $uid
     * @return boolean
     */
    public function getUserHash($uid) {
        $result = user::get(['hash' => $uid]);
        if (!$result) {
            $this->error = "不存在用户";
            return false;
        }
        return $result;
    }

    /**
     * 用户注册
     * @author chenran(apizl) <apiziliao@gmail.com>
     * @return boolean
     */
    public function register() {
        if (empty($this->data['name'])) {
            $this->error = "用户名不能为空";
            return false;
        }
        $user = user::get(['name' => $this->data['name']]);
        if ($user) {
            $this->error = "当前用户名已被注册";
            return false;
        }
        $this->data['salt'] = $salt = \app\index\controller\Base::guid();
        $this->data['password'] = md5($this->data['password'] . $salt);
        $this->data['login_ip'] = \app\index\controller\Base::getUserIp();
        $this->data['login_time'] = time();
        $this->data['add_time'] = time();
        $this->data['role'] = 0;
        $this->data['state'] = 1;
        return $this->save();
    }

    /**
     * 登录操作
     * @author chenran(apizl) <apiziliao@gmail.com>
     * @return boolean
     */
    public function login() {
        if (empty($this->data['name'])) {
            $this->error = "用户名不能为空";
            return false;
        }
        if (empty($this->data['password'])) {
            $this->error = "密码不能为空";
            return false;
        }
        $user = user::get(['name' => $this->data['name']]);
        if ($user) {
            $user = $user->toArray();
            $salt = $user['salt'];
            $userPassword = md5($this->data['password'] . $salt);
            if ($userPassword != $user['password']) {
                $this->error = "账号或密码不正确!";
                return;
            }
            $userToken = new user_token();
            $userToken->addToken($user['hash']);
            $this->token = $userToken->token;
            return $user;
        }
        $this->error = "用户不存在";
        return false;
    }

    /**
     * 判断是否登录
     * @author chenran(apizl) <apiziliao@gmail.com>
     * @return boolean
     */
    public function isLogin() {
        if (empty($this->data['token'])) {
            $this->error = "请重新登录";
            return false;
        }
        $result = \think\Db::table("user_token as ut")
                ->field('ut.token,u.name')
                ->join("user as u", 'u.hash=uk.uid')
                ->find();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
