<?php /* Smarty version 2.6.30, created on 2017-06-22 16:57:34
         compiled from index/error.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>科技园充电</title>
    <link rel="stylesheet" href="./weui.min.css"/>
    <link rel="stylesheet" href="./example.css"/>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
</head>
<body ontouchstart>
<div class="container">
<div class="page msg js_show">
    <div class="page msg_warn js_show">
        <div class="weui-msg">
            <div class="weui-msg__icon-area">
                <i class="weui-icon-warn weui-icon_msg"></i>
            </div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">操作失败</h2>
                <p class="weui-msg__desc"><?php echo $this->_tpl_vars['tpl']['msg']; ?>
</p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a href="javascript:history.back();" class="weui-btn weui-btn_primary">返回</a>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>