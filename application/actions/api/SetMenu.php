<?php
class Action_SetMenu extends Yaf_Action_abstract {
    public function execute() {
        $menu = '{
            "button":[{
                "type":"click",
                "name":"今日歌曲",
                "key":"V1001_TODAY_MUSIC"
            },
            {
                "name":"菜单",
                "sub_button":[{
                    "type":"view",
                    "name":"搜索",
                    "url":"http://www.soso.com/"
                },
                {
                    "type":"miniprogram",
                    "name":"wxa",
                    "url":"http://mp.weixin.qq.com",
                    "appid":"wx286b93c14bbf93aa",
                    "pagepath":"pages/lunar/index"
                },
                {
                    "type":"click",
                    "name":"赞一下我们",
                    "key":"V1001_GOOD"
                }]
            }]
        }';
        $jssdk = new Common_Jssdk();
        $access_token = $jssdk->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($curl);
        curl_close($curl);
        echo $res;
    }
}
