<?php

namespace app\index\controller;

/**
 * 用户注册
 * @author chenran(apizl) <apiziliao@gmail.com>
 */
class Register extends Base {

    public function index() {
        return $this->fetch('index');
    }

    /**
     * 用户注册接口
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function ajaxIndex() {
        if ($this->request->isPost()) {
            $user = new \app\index\model\user($this->request->post('', '', ['strip_tags', 'htmlspecialchars']));
            if ($user->register()) {
                $this->json('注册用户成功');
            } else {
                $this->json('注册用户失败:' . $user->error);
            }
        }
        $this->json('请求错误');
    }

    /**
     * 用户登录接口
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function ajaxLoginToken() {
        if ($this->request->isPost()) {
            $user = new \app\index\model\user($this->request->post('', '', ['strip_tags', 'htmlspecialchars']));
            $result = $user->login();
            if ($result) {
                session('userData', $result);
                $this->json('用户登录成功', 1, ['token' => $user->token]);
            } else {
                $this->json('用户登录失败:' . $user->error);
            }
        }
        $this->json('请求错误');
    }

    /**
     * 判断是否为登录状态
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function isLogin() {
        if (!$this->request->isPost()) {
            $this->json('请求出错');
        }
        $register = new \app\index\model\user($this->request->isPost());
        if ($register->isLogin()) {
            $this->json('已登录', 1);
        } else {
            $this->json('未登录');
        }
    }

}
