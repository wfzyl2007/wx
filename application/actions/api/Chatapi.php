<?php
class Action_Chatapi extends Yaf_Action_Abstract {
    public function execute() {
        if (isset($_GET['echostr'])) {
            $wechatobj = new Model_Service_Page_CheckSignature();
            $arrUri = $this->getCheckParam();
            if (false === $wechatobj->valid($arrUri)) {
                echo "";
                return false;
            }
            echo $arrUri['echostr'];
            return true;
        } else {
            $wechatobj = new Model_Service_Page_Chatapi();
            $arrUri = $this->getChatParam();
            $arrRes = $wechatobj->responseMsg($arrUri);
            if (empty($arrRes)) {
                return false;
            }
            $this->getView()->assign('data', $arrRes['data']);
            $this->getView()->display($arrRes['tpl']);
            return true;
        }
    }
    private function getCheckParam() {
        $param = array(
            'signature' => $_GET['signature'],
            'timestamp' => $_GET['timestamp'],
            'nonce' => $_GET['nonce'],
            'echostr' => $_GET['echostr'],
        );
        return $param;
    }
    private function getChatParam() {
        return array('xml' => $GLOBALS["HTTP_RAW_POST_DATA"]);
    }
}
