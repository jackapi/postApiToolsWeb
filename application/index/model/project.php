<?php

namespace app\index\model;

use think\Model;

class project extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'project';
    public $error = "";
    public $token = "";
    public $resultHash = "";

    /**
     * 创建项目文档
     * @author chenran(apizl) <apiziliao@gmail.com>
     * @param type $uid
     * @param type $projectHash
     * @return boolean
     */
    public function addProject($uid, $projectHash) {
        $result = project_setting::get(['hash' => $projectHash]);
        if (empty($result->hash)) {
            $this->error = "不存在栏目";
            return false;
        }
        if (empty($this->data['name'])) {
            $this->error = "文档名称不能为空";
            return false;
        }
        if (empty($this->data['desc'])) {
            $this->error = "文档内容不能为空";
            return false;
        }
        if (empty($this->data['url'])) {
            $this->error = "url不能为空";
            return false;
        }
        if (empty($this->data['urldata'])) {
            $this->error = "urldata不能为空";
            return false;
        }
        if (empty($this->data['method'])) {
            $this->error = "method不能为空";
            return false;
        }
        $this->project_id = $result->hash;
        $this->sort = 0;
        $this->uid = $uid;
        $this->edit_uid = '';
        $this->addtime = time();
        $this->hash = \app\index\controller\Base::guid();
        $result = $this->save();
        if ($result) {
            $this->resultHash = $this->hash;
            $this->error = "创建文档失败:" . $this->getError();
        }
        return $result;
    }

}
