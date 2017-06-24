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
        {%if $tpl.empty == 0 %}
            <p class="page__desc">现在队列为空，快去排队吧</p>
        {%elseif $tpl.inqueue == 1 %}
            <p class="page__desc">你已经在队列中了，排队情况如下</p>
        {%else%}
            <p class="page__desc">排队情况如下</p>
        {%/if%}

    </div>
    <div class="page__bd page__bd_spacing">
            {%if $tpl.empty == 1 %}
            <table class="weui-cell weui-cells_form" style="text-align:center;">
                <tr style="background-color:#9ed99d;">
                    <th>姓名</th>
                    <th>车牌</th>
                    <th>位置</th>
                    <th>类型</th>
                </tr>
                {%foreach item=item from=$tpl.row %}
                <tr>
                    <td class="weui-cell__bd">{%$item.name|escape:"html"%}</td>
                    <td class="weui-cell__bd">{%$item.number%}</td>
                    <td class="weui-cell__bd">
                        {%if $item.place == 2%}仅限K1
                        {%elseif $item.place == 3%}仅限K2
                        {%else%}不限
                        {%/if%}
                    </td>
                    <td class="weui-cell__bd">
                        {%if $item.type == 2%}智充
                        {%elseif $item.type == 3%}普天
                        {%else%}插座
                        {%/if%}
                    </td>
                </tr>
                {%/foreach%}
            </table>
            {%/if%}
            {%if $tpl.inqueue == 0 %}
            <button class="weui-btn weui-btn_primary" onClick="location.href='{%$tpl.queue_link%}'">去排队</button>
            {%else%}
            <button class="weui-btn weui-btn_warn" onClick="location.href='{%$tpl.quit_link%}'">不排了</button>
            {%/if%}
    </div>
</div>
</div>
</body>
</html>
