<?php
class Service_Page_Chat {
    public function responseMsg() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            switch ($RX_TYPE) {
                case "text":
                    $resultStr = $this->receiveText($postObj);
                    break;
                default:
                    $resultStr = "unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $resultStr;
        } else {
            echo "";
        }
    }
    private function receiveText($object) {
        $funcFlag = 0;
        $contentStr = $object->Content;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }
}
