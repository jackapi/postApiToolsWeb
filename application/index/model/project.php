<?php

namespace app\index\model;

use think\Model;

class project extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'project';
    public $error = "";
    public $token = "";

    public function addProject($uid, $projectHash) {
        $result = project_setting::get(['hash' => $projectHash]);
        if (!$result->hash) {
            $this->error = "不存在栏目";
            return false;
        }
        $this->uid = $uid;
        $this->edit_uid = '';
        $this->addtime = time();
        $this->hash = \app\index\controller\Base::guid();
        return $this->save();
    }

}
