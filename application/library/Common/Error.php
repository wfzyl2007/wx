<?php
class Common_Error {
    const LEVEL_SUCC = "success";
    const LEVEL_INFO = "info";
    const LEVEL_WARN = "warn";
    const TITLE_SUCC = "操作成功";
    const TITLE_INFO = "";
    const TITLE_WARN = "操作失败";
    const OK = 0;
    const ERR_OUTRANGE = 1;
    const ERR_TIMEOUT = 2;
    const ERR_PARAM = 3;
    const INFO_INQUEUE = 4;
    public function getMsg($e) {
        $msg = array('link' => "#");
        switch ($e) {
        case self::OK:
            $msg['msg'] = "请关注hi群：1473221，及时了解排队进度";
            $msg['title'] = self::TITLE_SUCC;
            $msg['level'] = self::LEVEL_SUCC;
            break;
        case self::INFO_INQUEUE:
            $msg['msg'] = "您已经在队列中了";
            $msg['title'] = self::TITLE_INFO;
            $msg['level'] = self::LEVEL_INFO;
            break;
        case self::ERR_OUTRANGE:
            $msg['msg'] = "请在公司附近排队";
            $msg['title'] = self::TITLE_WARN;
            $msg['level'] = self::LEVEL_WARN;
            break;
        case self::ERR_TIMEOUT:
            $msg['msg'] = "距离您上次操作已经很久了，请重新在公众号输入『排队』，进入页面";
            $msg['title'] = self::TITLE_WARN;
            $msg['level'] = self::LEVEL_WARN;
            break;
        case self::ERR_PARAM:
            $msg['msg'] = "参数错误，请从公众号输入『排队』，进入页面";
            $msg['title'] = self::TITLE_WARN;
            $msg['level'] = self::LEVEL_WARN;
            break;
        default:
            $msg['msg'] = "未知错误";
            $msg['title'] = "操作失败";
            $msg['level'] = self::LEVEL_WARN;
            break;
        }
        return $msg;
    }
}
