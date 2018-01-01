<?php

namespace app\index\controller;

/**
 * 文档
 * @author chenran(apizl) <apiziliao@gmail.com> 
 */
class Document extends UserBase {

    public function index() {
        //return $this->fetch('index');
    }

    /**
     * 创建项目
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function createProject() {
        
    }

    /**
     * 创建项目Ajax
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function createProjectAjax() {
        if ($this->request->isPost()) {
            $projectSetting = new \app\index\model\project_setting($this->request->post());
            if ($projectSetting->addProject($this->userData->hash)) {
                $this->json('创建成功', 1, $projectSetting->resultHash);
            } else {
                $this->json('创建失败：' . $projectSetting->getError());
            }
            $this->json('创建出错');
        }
        $this->json('请求错误');
    }

    /**
     * 创建子类Ajax
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function createProjectPidAjax() {
        if ($this->request->isPost()) {
            $projectSetting = new \app\index\model\project_setting($this->request->post());
            if ($projectSetting->addProjectPid($this->userData->hash)) {
                $this->json('创建子类成功', 1, $projectSetting->resultHash);
            } else {
                $this->json('创建子类失败：' . $projectSetting->getError());
            }
            $this->json('创建出错');
        }
        $this->json('请求错误');
    }

    /**
     * 创建文档
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function createDocument() {
        if ($this->request->isPost()) {
            $projectHash = $this->request->post('project_hash', '');
            if (empty($projectHash)) {
                $this->json('文档栏目不正确');
            }
            $project = new \app\index\model\project($this->request->post());
            if ($project->addProject($this->userData->hash, $projectHash)) {
                $this->json('添加成功', 1, $project->resultHash);
            } else {
                $this->json('添加失败:' . $project->getError());
            }
        }
        $this->json('请求出错');
    }

}
