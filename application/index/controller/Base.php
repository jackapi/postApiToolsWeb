<?php

namespace app\index\controller;

/**
 * 公用继承类库
 * @author chenran(apizl) <apiziliao@gmail.com>
 */
class Base extends \think\Controller {

    /**
     * 获取请求ip
     * @return type
     */
    public static function getUserIp() {
        $r = new \think\Controller();
        return $r->request->ip();
    }

    /**
     * guid 获取
     * @return type
     */
    public static function guid() {
        $guid = '';
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            $uuid = chr(123)
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125);
            $guid = $uuid;
        }
        $guid = substr($guid, 1);
        $guid = substr($guid, 0, strlen($guid) - 1);
        return $guid;
    }

    /**
     * json 返回
     * @author chenran(apizl) <apiziliao@gmail.com>
     * @param type $msg
     * @param type $code
     * @param type $result
     */
    public function json($msg, $code = 0, $result = []) {
        header('Content-Type:application/json; charset=utf-8');
        $data = [
            'msg' => $msg,
            'code' => $code,
            'result' => $result,
        ];
        exit(json_encode($data, JSON_UNESCAPED_UNICODE));
    }

}
