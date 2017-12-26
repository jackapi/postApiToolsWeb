<?php

namespace app\manage\controller;
/**
 * 后台管理
 * @author chenran(apizl) <apiziliao@gmail.com>
 */
class Index extends \think\Controller {

    public function index() {
        return $this->fetch('index');
    }

}
