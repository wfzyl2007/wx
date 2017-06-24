<?php /* Smarty version 2.6.30, created on 2017-06-22 22:39:12
         compiled from index/queue.tpl */ ?>
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
        <h1 class="page_title">排队申请</h1>
    </div>
    <div class="page__bd page__bd_spacing">
                    <form action="./queue" method="post" onsubmit="return checkSubmit();">
                        <div class="weui-cells__title">车主信息</div>
                        <div class="weui-cells weui-cells_form">
                            <div class="weui-cell" id="div_name_cell">
                                <div class="weui-cell__hd">
                                    <label class="weui-label">姓名</label>
                                </div>
                                <div class="weui-cell__bd">
                                    <input
                                        class="weui-input"
                                        name="name"
                                        type="text"
                                        maxlength=10
                                        placeholder="请输入姓名"
                                        value="<?php echo $this->_tpl_vars['tpl']['name']; ?>
"
                                        onblur="checkName()"
                                        id="input_name">
                                </div>
                                <div class="weui-cell__ft">
                                    <i class="weui-icon-warn"></i>
                                </div>
                            </div>
                            <div class="weui-cell">
                                <div class="weui-cell__hd">
                                    <label class="weui-label">车牌后三位</label>
                                </div>
                                <div class="weui-cell__bd">
                                    <input
                                        class="weui-input"
                                        name="number"
                                        type="text"
                                        maxlength=3
                                        placeholder="请输入车牌号后三位"
                                        value="<?php echo $this->_tpl_vars['tpl']['number']; ?>
"
                                        onkeyup="checkCarNum()"
                                        id="input_num">
                                </div>
                            </div>
                        </div>
                        <div class="weui-cells__title">停放位置</div>
                        <div class="weui-cells weui-cells_form">
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <select class="weui-select" name="place">
                                        <option value="1" <?php if ($this->_tpl_vars['tpl']['place'] == 1): ?> selected="selected" <?php endif; ?>>不限</option>
                                        <option value="2" <?php if ($this->_tpl_vars['tpl']['place'] == 2): ?> selected="selected" <?php endif; ?>>仅停K1</option>
                                        <option value="3" <?php if ($this->_tpl_vars['tpl']['place'] == 3): ?> selected="selected" <?php endif; ?>>仅停K2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="weui-cells__title">充电类型</div>
                        <div class="weui-cells weui-cells_form">
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <select class="weui-select" name="type">
                                        <option value="1" <?php if ($this->_tpl_vars['tpl']['type'] == 1): ?> selected="selected" <?php endif; ?>>插座</option>
                                        <option value="2" <?php if ($this->_tpl_vars['tpl']['type'] == 2): ?> selected="selected" <?php endif; ?>>智充</option>
                                        <option value="3" <?php if ($this->_tpl_vars['tpl']['type'] == 3): ?> selected="selected" <?php endif; ?>>普天</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="weui-cells weui-cells_form">
                            <div class="weui-cell">
                            <input type="hidden" value="" name="lat" id="input_lat">
                            <input type="hidden" value="" name="lng" id="input_lng">
                            <input type="hidden" value="<?php echo $this->_tpl_vars['tpl']['openid']; ?>
" name="openid">
                            <input type="hidden" value="<?php echo $this->_tpl_vars['tpl']['timestamp']; ?>
" name="timestamp">
                            <input type="hidden" value="<?php echo $this->_tpl_vars['tpl']['sign']; ?>
" name="sign">
                            <input type="submit" class="weui-btn weui-btn_primary" value="排队">
                            </div>
                        </div>
                    </form>
    </div>
</div>
</div>
</body>
<script>
    wx.config({
        debug: false,
        appId: '<?php echo $this->_tpl_vars['tpl']['js']['appId']; ?>
',
        timestamp: <?php echo $this->_tpl_vars['tpl']['js']['timestamp']; ?>
,
        nonceStr: '<?php echo $this->_tpl_vars['tpl']['js']['nonceStr']; ?>
',
        signature: '<?php echo $this->_tpl_vars['tpl']['js']['signature']; ?>
',
        jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
            'getLocation'
        ]
    });
    wx.ready(function () {
        // 在这里调用 API
        wx.getLocation({
            success: function (res) {
                var input_lat = document.getElementById('input_lat');
                input_lat.value = res.latitude;
                var input_lng = document.getElementById('input_lng');
                input_lng.value = res.longitude;
            },
            cancel: function (res) {
                //alert('用户拒绝授权获取地理位置');
            }
        });
    });
    function checkCarNum() {
        var input_num = document.getElementById('input_num');
        var txt = input_num.value.replace(/\W/g,"");
        input_num.value = txt;
    }
    function checkName() {
        var input_name = document.getElementById('input_name');
        var cell = document.getElementById('div_name_cell');
        if (input_name.value.length == 0) {
            cell.className="weui-cell weui-cell_warn";
        } else {
            cell.className="weui-cell";
        }
    }
    function checkSubmit() {
        var input_name = document.getElementById('input_name');
        var input_num = document.getElementById('input_num');
        var input_lat = document.getElementById('input_lat');
        var input_lng = document.getElementById('input_lng');
        if (input_name.value == "") {
            alert("请输入姓名");
            checkName();
            return false;
        }
        if (input_num.value == "") {
            alert("请输入车牌号后三位");
            return false;
        }
        if (input_lat.value == "" || input_lng.value == "") {
            alert("获取位置信息失败，无法排队");
            return false;
        }
    }
</script>
</html>