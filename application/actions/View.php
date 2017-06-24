<?php
class Action_View extends Action_Base {

    private function processGetRequest() {
        $ret = $this->checkGetParam();
        if ($ret !== Common_Error::OK) {
            $this->infoPage($ret);
            return false;
        }
        $inqueue = 0;
        $userObj = new Model_Service_Data_User();
        $user_ret = $userObj->checkUser($this->openid);
        if (false !== $user_ret) {
            $date = date("Ymd");
            if (strcmp($user_ret['day'], $date) === 0) {
                $inqueue = 1;
            }
            if (isset($_GET['quit']) && $_GET['quit'] == 'true') {
                $userObj->quitUser($this->openid, 0, '0');
                $inqueue = 0;
            }
        }

        $tplData = array(
            'openid' => $this->openid,
            'timestamp' => $this->timestamp,
            'sign' => $this->sign,
            'inqueue' => $inqueue,
            'queue_link' => "./queue?openid=$this->openid&timestamp=$this->timestamp&sign=$this->sign",
            'quit_link' => "./view?openid=$this->openid&timestamp=$this->timestamp&sign=$this->sign&quit=true",
            'empty' => 0,
            'row' => array(),
        );
        $user_ret = $userObj->getQueueUser();
        if (false !== $user_ret) {
            $tplData['row'] = $user_ret;
            $tplData['empty'] = 1;
        }
        $this->getView()->assign("tpl", $tplData);
        $this->getView()->display('index/view.tpl');
    }

    public function execute() {
        if ($this->getIsPostRequest()) {
            //POST
            $this->infoPage(Common_Error::ERR_PARAM);
        } else {
            //GET
            $this->processGetRequest();
        }
    }
}
