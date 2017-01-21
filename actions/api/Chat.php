<?php
class Action_Chat extends Sm_Base_PageAction {
    public function executeIt() {
        //这个方法将被调用
        if (isset($_GET['echostr'])) {
            $wechatobj = new Service_Page_CheckSignature();
            $wechatobj->valid();
        } else {
            $wechatobj = new Service_Page_Chat();
            $wechatobj->responseMsg();
        }
    }
}
