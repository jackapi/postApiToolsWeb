<?php

namespace app\index\controller;

class Index extends Base {

    public function index() {
        return $this->fetch('index');
    }
    /**
     * 测试sqlite
     */
    public function testSqlite(){
       $result= \think\Db::table('user')
                ->find();
        var_dump($result);
        $this->json('1',1,1);
    }

}
