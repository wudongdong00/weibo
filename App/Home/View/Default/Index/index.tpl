<extend name="Common/base" />
<block name="head">
    <script type="text/javascript" src="__js__/rl_exp.js"></script>
    <script type="text/javascript" src="__js__/wu_pic.js"></script>
    <script type="text/javascript" src="__upload__/jquery.uploadify.js"></script>
    <script type="text/javascript" src="__js__/jquery.scrollUp.js"></script>
    <script type="text/javascript" src="__js__/index.js"></script>
    <link rel="stylesheet" href="__css__/rl_exp.css"/>
    <link rel="stylesheet" href="__upload__/uploadify.css"/>
    <link rel="stylesheet" href="__css__/public.css"/>
    <link rel="stylesheet" href="__css__/index.css"/>
</block>
<block name="main">
    <div class="main_left">
        <div class="form_mes">
            <span class="left">和大家分享一点新鲜事吧！</span>
            <span class="num form_num" >可以输入<strong>140</strong>个字</span>
            <textarea class="form_text" id="rl_exp_input"></textarea>
            <a href="javascript:void(0);" class="form_face" id="rl_exp_btn">表情<span class="face_arrow_top"></span></a>
                <div class="rl_exp" id="rl_bq" style="display:none;">
                    <ul class="rl_exp_tab clearfix">
                        <li><a href="javascript:void(0);" class="selected">默认</a></li>
                        <li><a href="javascript:void(0);">拜年</a></li>
                        <li><a href="javascript:void(0);">浪小花</a></li>
                        <li><a href="javascript:void(0);">暴走漫画</a></li>
                    </ul>
                    <ul class="rl_exp_main clearfix rl_selected"></ul>
                    <ul class="rl_exp_main clearfix" style="display:none;"></ul>
                    <ul class="rl_exp_main clearfix" style="display:none;"></ul>
                    <ul class="rl_exp_main clearfix" style="display:none;"></ul>
                    <a href="javascript:void(0);" class="close">×</a>
                </div>
            <a href="javascript:void(0);" class="form_pic" id="pic_btn">图片<span class="pic_arrow_top"></span></a>
            <div class="pic_box" id="pic_boxed" style="display:none;">
                <div class="pic_header"><span class="pic_line">共<span class="pic_total">0</span>张  还可以选择<span class="pic_limit">8</span>张 （按Ctrl可选择多张）</span> </div>
                <a href="javascript:void(0);" class="close">×</a>
                <div class="pic_list"></div>
                <input type="file" name="file" id="file">
            </div>
            <input type="button" class="form_button" value="发布">
        </div>
        <div class="weibo_content">
            <ul>
                <li><a href="javascript:void(0);" class="selected">我关注的<i class="content_arrow"></i></a></li>
                <li><a href="javascript:void(0);">互相关注</a></li>
            </ul>
            <div class="msg">约 0 条新广播，点击查看</div>
            <volist name="topList" id="obj">
                <empty name="obj.reid">
                        <dl class="content_data">
                            <dt><a href="javascript:void(0);">
                                    <empty name="obj.face">
                                        <empty name="obj.domin">
                                            <a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__img__/small_face.jpg" border="0" alt=""></a>
                                            <else/>
                                            <a href="__ROOT__/i/{$obj.domin}"><img src="__img__/small_face.jpg" border="0" alt=""></a>
                                        </empty>
                                        <else/>
                                        <empty name="obj.domin">
                                            <a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
                                            <else/>
                                            <a href="__ROOT__/i/{$obj.domin}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
                                        </empty>
                                    </empty>
                                </a></dt>
                            <dd>
                                <h4>
                                    <empty name="obj.domin">
                                        <a href="{:U('Space/index', array('id'=>$obj['uid']))}">{$obj.user}</a>
                                        <else/>
                                        <a href="__ROOT__/i/{$obj.domin}">{$obj.user}</a>
                                    </empty>
                                </h4>
                                <p>{$obj.content}</p>
                                <switch name="obj.count">
                                    <case value="0"></case>
                                    <case value="1">
                                        <div class="img" ><img src="__ROOT__/{$obj['image'][0]['thumb']}" alt="" class="thumb"></div>
                                        <div class="img_zoom"  >
                                            <ol>
                                                <li class="in"><a href="javascript:void(0);">收起</a></li>
                                                <li class="source"><a href="__ROOT__/{$obj['image'][0]['source']}" target="_blank">查看原图</a></li>
                                            </ol>
                                            <img data="__ROOT__/{$obj['image'][0]['unfold']}" src="__img__/loading_100.png" alt="" class="unfold">
                                        </div>
                                    </case>
                                    <default />
                                    <for start="0" end="$obj['count']">
                                        <div class="lots_img" style="display: block"><img src="__ROOT__/{$obj['image'][$i]['thumb']}" alt=""></div>
                                    </for>
                                    <div class="scroll" style="margin:0 auto;width:550px;display: none">
                                        <!-- "prev page" link -->
                                        <a class="prev" href="javascript:void(0)"></a>
                                        <ol>
                                            <li class="in_box"><a href="javascript:void(0);">收起</a></li>
                                            <li class="source_box"><a href="__ROOT__/{$obj['image'][0]['source']}" target="_blank">查看原图</a></li>
                                        </ol>
                                        <div class="box">
                                            <div class="scroll_list">
                                                    <for start="0" end="$obj['count']">
                                                        <div class="imgs"><img src="__ROOT__/{$obj['image'][$i]['unfold']}" alt=""></div>
                                                    </for>
                                            </div>
                                        </div>
                                        <!-- "next page" link -->
                                        <a class="next" href="javascript:void(0)"></a>
                                    </div>
                                </switch>
                                <div class="footer">
                                    <span class="time">{$obj.time}</span>
                                    <span class="handler">赞（0）| <a href="javascript:void (0)" class="re">转发({$obj.recount})</a> | <a href="javascript:void (0)" class="com">评论({$obj.comcount})</a> | 收藏 </span>
                                    <div class="re_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="re_text re_com_text" name="commend"></textarea>
                                        <input type="hidden" name="reid" value="{$obj.id}">
                                        <input type="button" value="转发" class="re_button">
                                    </div>
                                    <div class="com_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="com_text re_com_text" name="commend"></textarea>
                                        <input type="hidden" name="tid" value="{$obj.id}">
                                        <input type="button" value="评论" class="com_button">
                                        <div class="commend_content">

                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    <else/>
                        <dl class="content_data">
                            <dt><a href="javascript:void(0);">
                                    <empty name="obj.face">
                                        <empty name="obj.domin">
                                            <a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__img__/small_face.jpg" border="0" alt=""></a>
                                            <else/>
                                            <a href="__ROOT__/i/{$obj.domin}"><img src="__img__/small_face.jpg" border="0" alt=""></a>
                                        </empty>
                                        <else/>
                                        <empty name="obj.domin">
                                            <a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
                                            <else/>
                                            <a href="__ROOT__/i/{$obj.domin}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
                                        </empty>
                                    </empty>
                                </a></dt>
                            <dd>
                                <h4>
                                    <empty name="obj.domin">
                                        <a href="{:U('Space/index', array('id'=>$obj['uid']))}">{$obj.user}</a>
                                        <else/>
                                        <a href="__ROOT__/i/{$obj.domin}">{$obj.user}</a>
                                    </empty>
                                </h4>
                                <p>{$obj.content}</p>
                                <div class="re_content" style="overflow: auto">
                                    <h5>
                                        <empty name="obj.recontent.domin">
                                            <a href="{:U('Space/index', array('id'=>$obj['recontent']['uid']))}">@{$obj.recontent.user}</a>
                                        <else/>
                                            <a href="__ROOT__/i/{$obj.recontent.domin}">@{$obj.recontent.user}</a>
                                        </empty>
                                    </h5>
                                    <p>{$obj.recontent.content}</p>
                                    <switch name="obj.recontent.count">
                                        <case value="0"></case>
                                        <case value="1">
                                            <div class="img" ><img src="__ROOT__/{$obj['recontent']['image'][0]['thumb']}" alt="" class="thumb"></div>
                                            <div class="img_zoom"  >
                                                <ol>
                                                    <li class="in"><a href="javascript:void(0);">收起</a></li>
                                                    <li class="source"><a href="__ROOT__/{$obj['recontent']['image'][0]['source']}" target="_blank">查看原图</a></li>
                                                </ol>
                                                <img data="__ROOT__/{$obj['recontent']['image'][0]['unfold']}" src="__img__/loading_100.png" alt="" class="unfold">
                                            </div>
                                        </case>
                                        <default />
                                            <for start="0" end="$obj['recontent']['count']">
                                                <div class="lots_img" style="display: block"><img src="__ROOT__/{$obj['recontent']['image'][$i]['thumb']}" alt=""></div>
                                            </for>
                                        <div class="scroll" style="margin:0 auto;width:550px;display: none">
                                            <!-- "prev page" link -->
                                            <a class="prev" href="javascript:void(0)"></a>
                                            <ol>
                                                <li class="in_box"><a href="javascript:void(0);">收起</a></li>
                                                <li class="source_box"><a href="__ROOT__/{$obj['recontent']['image'][0]['source']}" target="_blank">查看原图</a></li>
                                            </ol>
                                            <div class="box">
                                                <div class="scroll_list">
                                                    <for start="0" end="$obj['count']">
                                                        <div class="imgs"><img src="__ROOT__/{obj['recontent']['image'][$i]['unfold']}" alt=""></div>
                                                    </for>
                                                </div>
                                            </div>
                                            <!-- "next page" link -->
                                            <a class="next" href="javascript:void(0)"></a>
                                        </div>
                                    </switch>
                                        <div class="footer">
                                        <span class="time">{$obj.recontent.time}</span>
                                        <span class="handler">赞(0) 　<a href="javascript:void (0)" class="re">转发({$obj.recontent.recount})</a> 　评论  </span>
                                        </div>
                                </div>
                                <div class="footer">
                                    <span class="time">{$obj.time}</span>
                                    <span class="handler">赞（0）| <a href="javascript:void (0)" class="re">转发</a> | <a href="javascript:void (0)" class="com">评论()</a> | 收藏 </span>
                                    <div class="re_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="re_text re_com_text" name="commend"> || @{$obj.user} :{$obj.textarea}</textarea>
                                        <input type="hidden" name="reid" value="{$obj.reid}">
                                        <input type="button" value="转发" class="re_button">
                                    </div>
                                    <div class="com_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="com_text re_com_text" name="commend"></textarea>
                                        <input type="hidden" name="tid" value="{$obj.reid}">
                                        <input type="button" value="评论" class="com_button">
                                        <div class="commend_content">

                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                </empty>
            </volist>
            <div id="load_more">加载更多中哦<img src="__img__/load_more.gif"></div>
            <div id="ajax_html1" style="display: none">
                <dl class="content_data">
                    <dt><a href="javascript:void(0);">
                            <empty name="smallFace">
                                <img src="__img__/small_face.jpg" alt="">
                                <else />
                                <img src="__ROOT__/{$smallFace}" alt="">
                            </empty>
                        </a></dt>
                    <dd>
                        <h4><a href="javascript:void(0);">{:session('user_auth')['user']}</a></h4>
                        <p>#内容#</p>
                        <div class="footer">
                            <span class="time">刚刚发布</span>
                            <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
                        </div>
                    </dd>
                </dl>
            </div>
            <div id="ajax_html2" style="display: none">
                <dl class="content_data">
                    <dt><a href="javascript:void(0);">
                            <empty name="smallFace">
                                <img src="__img__/small_face.jpg" alt="">
                                <else />
                                <img src="__ROOT__/{$smallFace}" alt="">
                            </empty>
                        </a></dt>
                    <dd>
                        <h4><a href="javascript:void(0);">{:session('user_auth')['user']}</a></h4>
                        <p>#内容#</p>
                                <div class="img" ><img src="__ROOT__/#缩略图#" alt="" class="thumb"></div>
                                <div class="img_zoom"  >
                                    <ol>
                                        <li class="in"><a href="javascript:void(0);">收起</a></li>
                                        <li class="source"><a href="__ROOT__/#原图#" target="_blank">查看原图</a></li>
                                    </ol>
                                    <img data="__ROOT__/#放大图#" src="__img__/loading_100.png" alt="" class="unfold">
                                </div>
                        <div class="footer">
                            <span class="time">刚刚发布</span>
                            <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
                        </div>
                    </dd>
                </dl>
            </div>
            <div id="ajax_html3" style="display: none">
                <dl class="content_data">
                    <dt><a href="javascript:void(0);">
                            <empty name="smallFace">
                                <img src="__img__/small_face.jpg" alt="">
                                <else />
                                <img src="__ROOT__/{$smallFace}" alt="">
                            </empty>
                        </a></dt>
                    <dd>
                        <h4><a href="javascript:void(0);">{:session('user_auth')['user']}</a></h4>
                        <p>#内容#</p>
                        <for start="0" end="$obj['count']" >
                            <div class="lots_img" style="display: block"><img src="__ROOT__/#多图缩略{$i}#" alt=""></div>
                        </for>
                        <div class="scroll" style="margin:0 auto;width:550px;display: none">
                            <!-- "prev page" link -->
                            <a class="prev" href="javascript:void(0)"></a>
                                <ol>
                                    <li class="in_box"><a href="javascript:void(0);">收起</a></li>
                                    <li class="source_box"><a href="__ROOT__/#多图原图#"  target="_blank">查看原图</a></li>
                                </ol>
                            <div class="box">
                                <div class="scroll_list">
                                    <for start="0" end="$obj['count']">
                                        <div class="imgs"><img src="__ROOT__/#多图放大{$i}#" alt=""></div>
                                    </for>
                                </div>
                            </div>
                            <!-- "next page" link -->
                            <a class="next" href="javascript:void(0)"></a>
                        </div>
                        <div class="footer">
                            <span class="time">刚刚发布</span>
                            <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="main_right">
        <empty name="bigFace">
            <img src="__img__/big.jpg" alt="" class="face">
            <else />
            <img src="__ROOT__/{$bigFace}" alt="" class="face">
        </empty>
        <span class="user">
            <a href="#">{:session('user_auth')['user']}</a>
        </span>
    </div>
</block>