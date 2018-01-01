<?php

namespace app\index\model;

use think\Model;

class project_setting extends Model {

    protected $field = true; //过滤不存在的字段
    protected $table = 'project_setting';
    protected $insert = ['hash'];
    public $error = "";
    public $token = "";

    protected function setHashAttr() {
        $this->resultHash = \app\index\controller\Base::guid();
        return $this->resultHash;
    }

    protected function setAddTimeAttr() {
        return time();
    }

    /**
     * 添加项目
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function addProject($uid) {
        if (empty($this->data['name'])) {
            $this->error = "项目名称不能为空";
            return false;
        }
        if (empty($this->data['sort'])) {
            $this->data['sort'] = 0;
        }
        if (empty($this->data['desc'])) {
            $this->data['desc'] = "";
        }
        $this->uid = $uid;
        $this->pid = 0;
        $this->role = -1;
        $this->role_type = -1;
        $this->addtime = time();
        $result = $this->save();
        $this->resultHash = $this->hash;
        return $result;
    }

    public $resultHash = "";

    /**
     * 添加子类
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function addProjectPid($uid) {
        if (empty($this->data['pid'])) {
            $this->error = "上级不能为空";
            return;
        }
        $pidResult = project_setting::get(['hash' => $this->data['pid']]);
        $this->pid = $pidResult->hash;
        if (empty($this->data['name'])) {
            $this->error = "名称不能为空";
            return;
        }
        if (empty($this->data['sort'])) {
            $this->data['sort'] = 0;
        }
        if (empty($this->data['desc'])) {
            $this->data['desc'] = "";
        }
        $this->uid = $uid;
        $this->role = -1;
        $this->role_type = -1;
        $this->addtime = time();
        $result = $this->save();
        $this->resultHash = $this->hash;
        return $result;
    }

}
