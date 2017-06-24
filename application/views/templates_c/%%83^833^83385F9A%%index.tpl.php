<?php /* Smarty version 2.6.30, created on 2017-06-21 23:55:44
         compiled from index/index.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>科技园充电</title>
    <link rel="stylesheet" href="/weui.min.css"/>
</head>
<body ontouchstart>
<div class="containner">
    <form action="#" method="post" onsubmit="return checkSubmit();">
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
                        name="num"
                        type="text"
                        maxlength=3
                        placeholder="请输入车牌号后三位"
                        onkeyup="checkCarNum()"
                        id="input_num">
                </div>
            </div>
        </div>
    </div>
    <div class="weui-cells__title">停放位置</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <select class="weui-select" name="place">
                        <option value="1">不限</option>
                        <option value="2">仅停K1</option>
                        <option value="3">仅停K2</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="weui-cells__title">充电类型</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <select class="weui-select" name="type">
                        <option value="1">插座</option>
                        <option value="2">智充</option>
                        <option value="3">普天</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" class="weui-btn weui-btn_primary" value="排队">
    </form>
</div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    wx.config({
        debug: false,
        appId: '<?php echo $this->_tpl_vars['tpl']['sign']['appId']; ?>
',
        timestamp: <?php echo $this->_tpl_vars['tpl']['sign']['timestamp']; ?>
,
        nonceStr: '<?php echo $this->_tpl_vars['tpl']['sign']['nonceStr']; ?>
',
        signature: '<?php echo $this->_tpl_vars['tpl']['sign']['signature']; ?>
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
                //alert(JSON.stringify(res));
                //alert(res.latitude);
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
        if (input_name.value == "") {
            alert("请输入姓名");
            return false;
        }
        if (input_num.value == "") {
            alert("请输入车牌号后三位");
            return false;
        }
    }
</script>
</html>
