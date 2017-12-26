<?php

namespace app\index\controller;

class Index extends \think\Controller {

    public function index() {
        return $this->fetch('index');
    }
    /**
     * 测试sqlite
     */
    public function testSqlite(){
       $result= \think\Db::table('history')
                ->find();
        var_dump($result);
    }

}
