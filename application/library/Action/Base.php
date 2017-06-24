<?php
class Action_Base extends Yaf_Action_Abstract {
    protected $openid = "";
    protected $timestamp = "0";
    protected $sign = "";

    protected function filterChar($str) {
        return preg_replace('/[^0-9a-zA-Z\-]+/', '', $str);
    }

    protected function getIsPostRequest() {
        return isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'], 'POST');
    }

    protected function checkGetParam() {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_GET['openid'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_GET['openid'])) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_GET['timestamp'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_GET['timestamp'])) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_GET['sign'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_GET['sign'])) {
            return Common_Error::ERR_PARAM;
        }
        $this->openid = self::filterChar($_GET['openid']);
        $this->timestamp = self::filterChar($_GET['timestamp']);
        $this->sign = self::filterChar($_GET['sign']);
        if (intval($this->timestamp) > time()) {
            return Common_Error::ERR_PARAM;
        }
        if (time() - intval($this->timestamp) > 18000) {
            return Common_Error::ERR_TIMEOUT;
        }
        $code = Common_Const::CODE_MASK;
        $string = "code=$code&openid=$this->openid&timestamp=$this->timestamp";
        $check_sign = sha1($string);
        if (strcmp($check_sign, $this->sign) !== 0) {
            return Common_Error::ERR_PARAM;
        }
        return Common_Error::OK;
    }

    protected function infoPage($errno) {
        $tplData = Common_Error::getMsg($errno);
        $tplData['link'] = "./view?openid=$this->openid&timestamp=$this->timestamp&sign=$this->sign";
        $this->getView()->assign("tpl", $tplData);
        $this->getView()->display('index/info.tpl');
    }

    public function execute() {
        return true;
    }
}
