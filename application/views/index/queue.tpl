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
                                        value="{%$tpl.name%}"
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
                                        value="{%$tpl.number%}"
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
                                        <option value="1" {%if $tpl.place == 1%} selected="selected" {%/if%}>不限</option>
                                        <option value="2" {%if $tpl.place == 2%} selected="selected" {%/if%}>仅停K1</option>
                                        <option value="3" {%if $tpl.place == 3%} selected="selected" {%/if%}>仅停K2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="weui-cells__title">充电类型</div>
                        <div class="weui-cells weui-cells_form">
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <select class="weui-select" name="type">
                                        <option value="1" {%if $tpl.type == 1%} selected="selected" {%/if%}>插座</option>
                                        <option value="2" {%if $tpl.type == 2%} selected="selected" {%/if%}>智充</option>
                                        <option value="3" {%if $tpl.type == 3%} selected="selected" {%/if%}>普天</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="weui-cells weui-cells_form">
                            <div class="weui-cell">
                            <input type="hidden" value="" name="lat" id="input_lat">
                            <input type="hidden" value="" name="lng" id="input_lng">
                            <input type="hidden" value="{%$tpl.openid%}" name="openid">
                            <input type="hidden" value="{%$tpl.timestamp%}" name="timestamp">
                            <input type="hidden" value="{%$tpl.sign%}" name="sign">
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
        appId: '{%$tpl.js.appId%}',
        timestamp: {%$tpl.js.timestamp%},
        nonceStr: '{%$tpl.js.nonceStr%}',
        signature: '{%$tpl.js.signature%}',
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
