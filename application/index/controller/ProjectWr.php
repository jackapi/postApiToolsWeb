<?php

namespace app\index\controller;

/**
 * 
 * @author chenran(apizl) <apiziliao@gmail.com>
 */
class ProjectWr extends UserBase {

    public function __construct(\think\Request $request = null) {
        parent::__construct($request);
        if (!$this->request->isPost()) {
            $this->sendIsPostError();
        }
    }

    public function getDocument() {
        $hash = $this->request->post("hash", "");
        if (empty($hash)) {
            $this->json('hash error');
        }
        $result = \app\index\model\project::get(['hash' => $hash]);
        if (empty($result)) {
            $this->json('不存在');
        }
        $result = $this->arrayFiledUnset($result, ['uid', 'edit_uid']);
        $this->json('ok', 1, $result);
    }

}
