<volist name="ajaxList" id="obj">
  <dl class="content_data">
    <dt><a href="javascript:void(0);">
        <empty name="obj.face">
          <img src="__img__/small_face.jpg" alt="">
          <else />
          <img src="__ROOT__/{$obj.face}" alt="">
        </empty>
      </a></dt>
    <dd>
      <h4><a href="javascript:void(0);">{$obj.user}</a></h4>
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
        <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
      </div>
    </dd>
  </dl>
</volist>