<?php /* Smarty version 2.6.30, created on 2017-06-23 13:27:22
         compiled from index/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'index/view.tpl', 36, false),)), $this); ?>
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
<div class="page js_show">
    <div class="page__hd">
        <h1 class="page_title">排队情况</h1>
        <?php if ($this->_tpl_vars['tpl']['empty'] == 0): ?>
            <p class="page__desc">现在队列为空，快去排队吧</p>
        <?php elseif ($this->_tpl_vars['tpl']['inqueue'] == 1): ?>
            <p class="page__desc">你已经在队列中了，排队情况如下</p>
        <?php else: ?>
            <p class="page__desc">排队情况如下</p>
        <?php endif; ?>

    </div>
    <div class="page__bd page__bd_spacing">
            <?php if ($this->_tpl_vars['tpl']['empty'] == 1): ?>
            <table class="weui-cell weui-cells_form" style="text-align:center;">
                <tr style="background-color:#9ed99d;">
                    <th>姓名</th>
                    <th>车牌</th>
                    <th>位置</th>
                    <th>类型</th>
                </tr>
                <?php $_from = $this->_tpl_vars['tpl']['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                    <td class="weui-cell__bd"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
                    <td class="weui-cell__bd"><?php echo $this->_tpl_vars['item']['number']; ?>
</td>
                    <td class="weui-cell__bd">
                        <?php if ($this->_tpl_vars['item']['place'] == 2): ?>仅限K1
                        <?php elseif ($this->_tpl_vars['item']['place'] == 3): ?>仅限K2
                        <?php else: ?>不限
                        <?php endif; ?>
                    </td>
                    <td class="weui-cell__bd">
                        <?php if ($this->_tpl_vars['item']['type'] == 2): ?>智充
                        <?php elseif ($this->_tpl_vars['item']['type'] == 3): ?>普天
                        <?php else: ?>插座
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['tpl']['inqueue'] == 0): ?>
            <button class="weui-btn weui-btn_primary" onClick="location.href='<?php echo $this->_tpl_vars['tpl']['queue_link']; ?>
'">去排队</button>
            <?php else: ?>
            <button class="weui-btn weui-btn_warn" onClick="location.href='<?php echo $this->_tpl_vars['tpl']['quit_link']; ?>
'">不排了</button>
            <?php endif; ?>
    </div>
</div>
</div>
</body>
</html>