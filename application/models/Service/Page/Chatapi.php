<?php
class Model_Service_Page_Chatapi {
    public function responseMsg($arrUri) {
        $arrRes = array();
        if (!empty($arrUri['xml'])) {
            $postObj = simplexml_load_string($arrUri['xml'], 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            switch ($RX_TYPE) {
                case 'text':
                    $arrRes = $this->receiveText($postObj);
                    break;
                case 'event':
                    $arrRes = $this->receiveEvent($postObj);
                    break;
                default:
                    //$arrRes = $this->receiveErrorType($postObj);
                    break;
            }
        }
        return $arrRes;
    }
    private function receiveText($postObj) {
        $text = $postObj->Content;
        if (strstr($text, '排队') === false) {
            return array();
        }
        $openid = trim($postObj->FromUserName);
        $timestamp = strval(time());
        $code = Common_Const::CODE_MASK;
        $string = "code=$code&openid=$openid&timestamp=$timestamp";
        $sign = sha1($string);
        $params = array(
            'openid' => $openid,
            'timestamp' => $timestamp,
            'sign' => $sign,
        );
        $text = "点击：<a href='http://wx.teebag.xin/view?".http_build_query($params)."'>排队情况</a>";
        $text .= " or <a href='http://wx.teebag.xin/queue?".http_build_query($params)."'>直接排队</a>";
        $postObj->Content = $text;
        $arrRes = $this->setBase($postObj);
        $arrRes['tpl'] = 'chatapi/text.tpl';
        return $arrRes;
    }
    private function receiveEvent($postObj) {
        $event = $postObj->Event;
        if (strcasecmp($event, 'subscribe') !== 0) {
            return array();
        }
        $openid = trim($postObj->FromUserName);
        $timestamp = strval(time());
        $code = Common_Const::CODE_MASK;
        $string = "code=$code&openid=$openid&timestamp=$timestamp";
        $sign = sha1($string);
        $params = array(
            'openid' => $openid,
            'timestamp' => $timestamp,
            'sign' => $sign,
        );
        $text = "欢迎关注科技园充电排队公众号\n";
        $text .= "回复『排队』即可进入排队页面\n";
        $text .= "<a href='http://wx.teebag.xin/view?".http_build_query($params)."'>排队情况</a>";
        $text .= " or <a href='http://wx.teebag.xin/queue?".http_build_query($params)."'>直接排队</a>";
        $postObj->Content = $text;
        $arrRes = $this->setBase($postObj);
        $arrRes['tpl'] = 'chatapi/text.tpl';
        return $arrRes;
    }
    private function receiveErrorType($postObj) {
        $arrRes = $this->setBase($postObj);
        $arrRes['data']['content'] = 'Unknown msg type.';
        $arrRes['tpl'] = 'chatapi/error.tpl';
        return $arrRes;
    }
    private function setBase($postObj) {
        $arrRes = array(
            'data' => array(
                //这里需要把发送方和接收方对调
                'fromUserName' => $postObj->ToUserName,
                'toUserName' => $postObj->FromUserName,
                'createTime' => time(),
                'funcFlag' => '0',
                'content' => $postObj->Content,
            ),
        );
        return $arrRes;
    }
}
