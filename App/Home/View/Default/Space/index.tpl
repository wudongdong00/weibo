<extend name="Common/base" />
<block name="head">
    <script type="text/javascript" src="__js__/space.js"></script>
    <link rel="stylesheet" href="__css__/space.css"/>
</block>
<block name="main">
    <div class="main_left">
        <div class="header">
            <dl>
                <empty name="bigFace">
                    <dt><img src="__img__/big.jpg" alt=""></dt>
                    <else/>
                    <dt><img src="__ROOT__/{$bigFace}" alt=""></dt>
                </empty>
                <dd class="user">{$user[0].user}</dd>
                <dd class="info">个人简介：{$user[0].extend.info}</dd>
            </dl>
        </div>
    </div>
    <div class="main_right">

    </div>
</block>