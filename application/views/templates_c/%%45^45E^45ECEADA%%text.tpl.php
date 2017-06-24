<?php /* Smarty version 2.6.30, created on 2017-01-26 20:26:01
         compiled from chatapi/text.tpl */ ?>
<xml>
<ToUserName><![CDATA[<?php echo $this->_tpl_vars['data']['toUserName']; ?>
]]></ToUserName>
<FromUserName><![CDATA[<?php echo $this->_tpl_vars['data']['fromUserName']; ?>
]]></FromUserName>
<CreateTime><?php echo $this->_tpl_vars['data']['createTime']; ?>
</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[<?php echo $this->_tpl_vars['data']['content']; ?>
]]></Content>
<FuncFlag><?php echo $this->_tpl_vars['data']['funcFlag']; ?>
</FuncFlag>
</xml>