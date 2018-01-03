<?php

namespace app\index\controller;

/**
 * 权限设置表
 * @author chenran(apizl) <apiziliao@gmail.com>
 */
class Role extends UserBase {

    public function __construct(\think\Request $request = null) {
        parent::__construct($request);
        if (!$this->request->isPost()) {
            $this->sendIsPostError();
        }
    }

    /**
     * 创建权限主类型
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function createRoleName() {
        $userRole = new \app\index\model\user_role($this->request->post());
        if ($userRole->addRole($this->userData['hash'])) {
            $this->json('添加权限角色成功');
        } else {
            $this->json('添加角色失败:' . $userRole->getError());
        }
    }

    /**
     * 获取自己主项目列表
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function getProjectSettingList() {
        $result = \app\index\model\project_setting::all(['uid' => $this->userData['hash'], 'pid' => 0]);
        if (empty($result)) {
            $this->json('没有项目喔！');
        }
        $result = $this->arrayFiledUnset($result, ['uid', 'role', 'role_type']);
        $this->json('ok', 1, $result);
    }

    /**
     * 获取自己主项目子类列表
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function getProjectSettingPidList() {
        $pid = $this->request->post('pid', '');
        if (empty($pid)) {
            $this->json('上级不能为空!');
        }
        $result = \app\index\model\project_setting::all(['uid' => $this->userData['hash'], 'pid' => $pid]);
        if (empty($result)) {
            $this->json('没有要显示的项目喔！');
        }
        $result = $this->arrayFiledUnset($result, ['uid', 'role', 'role_type']);
        $this->json('ok', 1, $result);
    }

    /**
     * 获取内容列表
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function getProjectList() {
        $hash = $this->request->post('hash', '');
        if (empty($hash)) {
            $this->json('上级不能为空!');
        }
        $result = \app\index\model\project::all(['uid' => $this->userData['hash'], 'project_id' => $hash]);
        if (empty($result)) {
            $this->json('没有要显示的内容喔！');
        }
        $result = $this->arrayFiledUnset($result, ['uid', 'role', 'role_type']);
        $this->json('ok', 1, $result);
    }

    /**
     * 创建权限主项目读写
     * @author chenran(apizl) <apiziliao@gmail.com>
     */
    public function createRoleProjectSetting() {
        
    }

}
