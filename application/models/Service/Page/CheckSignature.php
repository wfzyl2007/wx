<?php
class Model_Service_Page_CheckSignature {
    public function valid($arrUri) {
        $signature = $arrUri['signature'];
        $timestamp = $arrUri['timestamp'];
        $nonce = $arrUri['nonce'];
        $token = Common_WechatAuth::TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}
