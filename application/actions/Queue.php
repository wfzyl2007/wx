<?php
class Action_Queue extends Action_Base {
    private $name = "";
    private $number = "";
    private $type = 1;
    private $place = 1;
    private $lat = 0.0;
    private $lng = 0.0;

    private function processGetRequest() {
        $ret = $this->checkGetParam();
        if ($ret !== Common_Error::OK) {
            $this->infoPage($ret);
            return false;
        }
        $userObj = new Model_Service_Data_User();
        $user_ret = $userObj->checkUser($this->openid);
        if (false !== $user_ret) {
            $date = date("Ymd");
            if (strcmp($user_ret['day'], $date) === 0) {
                $this->infoPage(Common_Error::INFO_INQUEUE);
                return false;
            }
            $this->name = $user_ret['name'];
            $this->number = $user_ret['number'];
            $this->type = $user_ret['type'];
            $this->place = $user_ret['place'];
        }
        $jssdk = new Common_Jssdk();
        $jp = $jssdk->GetSignPackage();
        $tplData = array(
            'js' => $jp,
            'openid' => $this->openid,
            'timestamp' => $this->timestamp,
            'sign' => $this->sign,
            'name' => $this->name,
            'number' => $this->number,
            'type' => $this->type,
            'place' => $this->place,
        );
        $this->getView()->assign("tpl", $tplData);
        $this->getView()->display('index/queue.tpl');
        return true;
    }

    private function checkRange($v, $s, $e) {
        return ($s - $e < $v) && ($v < $s + $e);
    }

    private function checkPostParam() {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_POST['openid'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_POST['openid'])) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_POST['timestamp'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_POST['timestamp'])) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_POST['sign'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_POST['sign'])) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_POST['name'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_POST['name'])) {
            return Common_Error::ERR_PARAM;
        }
        if (!isset($_POST['number'])) {
            return Common_Error::ERR_PARAM;
        }
        if (empty($_POST['number'])) {
            return Common_Error::ERR_PARAM;
        }
        $this->openid = self::filterChar($_POST['openid']);
        $this->timestamp = self::filterChar($_POST['timestamp']);
        $this->sign = self::filterChar($_POST['sign']);
        $this->name = $_POST['name'];
        $this->number = self::filterChar($_POST['number']);
        $this->type = isset($_POST['type']) ? intval($_POST['type']) : 1;
        $this->place = isset($_POST['place']) ? intval($_POST['place']) : 1;
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
        $this->lat = isset($_POST['lat']) ? floatval($_POST['lat']) : 0.0;
        $this->lng = isset($_POST['lng']) ? floatval($_POST['lng']) : 0.0;
        if (!$this->checkRange($this->lat, Common_Const::CD_LAT, Common_Const::CD_ERR)) {
            return Common_Error::ERR_OUTRANGE;
        }
        if (!$this->checkRange($this->lng, Common_Const::CD_LNG, Common_Const::CD_ERR)) {
            return Common_Error::ERR_OUTRANGE;
        }
        return Common_Error::OK;
    }

    private function processPostRequest() {
        $ret = $this->checkPostParam();
        if ($ret !== Common_Error::OK) {
            $this->infoPage($ret);
            return false;
        }
        $userObj = new Model_Service_Data_User();
        $ret = $userObj->checkUser($this->openid);
        if ($ret === false) {
            $userObj->insertUser(
                $this->openid,
                $this->name,
                $this->number,
                $this->place,
                $this->type,
                time(),
                date("Ymd")
            );
            $this->infoPage(Common_Error::OK);
            return true;
        } else {
            $date = date("Ymd");
            if (strcmp($date, $ret['day']) === 0) {
                $this->infoPage(Common_Error::INFO_INQUEUE);
                return true;
            } else {
                $userObj->updateUser(
                    $this->openid,
                    $this->name,
                    $this->number,
                    $this->place,
                    $this->type,
                    time(),
                    date("Ymd")
                );
                $this->infoPage(Common_Error::OK);
                return true;
            }
        }
        return true;
    }

    public function execute() {
        if ($this->getIsPostRequest()) {
            //POST
            $this->processPostRequest();
        } else {
            //GET
            $this->processGetRequest();
        }
    }
}
?>
