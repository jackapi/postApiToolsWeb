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

    public function ajaxIndex() {
        if ($this->request->isPost()) {
            
        }
        $this->json('请求错误');
    }

}
