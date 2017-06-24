<?php /* Smarty version 2.6.30, created on 2017-06-23 10:34:52
         compiled from index/info.tpl */ ?>
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
    <div class="page msg_<?php echo $this->_tpl_vars['tpl']['level']; ?>
 js_show">
        <div class="weui-msg">
            <div class="weui-msg__icon-area">
                <i class="weui-icon-<?php echo $this->_tpl_vars['tpl']['level']; ?>
 weui-icon_msg"></i>
            </div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title"><?php echo $this->_tpl_vars['tpl']['title']; ?>
</h2>
                <p class="weui-msg__desc"><?php echo $this->_tpl_vars['tpl']['msg']; ?>
</p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <?php if ($this->_tpl_vars['tpl']['level'] == 'success' || $this->_tpl_vars['tpl']['level'] == 'info'): ?>
                    <a href="<?php echo $this->_tpl_vars['tpl']['link']; ?>
" class="weui-btn weui-btn_primary">查看排队</a>
                    <?php endif; ?>
                    <a href="javascript:history.back();" class="weui-btn weui-btn_default">返回</a>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>