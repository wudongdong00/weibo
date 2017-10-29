<ol class="commend">
  <volist name="getList" id="obj">
     <li>
        <empty name="obj.domin">
          <a href="{:U('Space/index', array('id'=>$obj['uid']))}">{$obj.user}</a>
          <else/>
          <a href="__ROOT__/i/{$obj.domin}">{$obj.user}</a>
        </empty>
       :{$obj.content}
     </li>
    <li class="line">{$obj.time}</li>
  </volist>
</ol>
<div class="page">
  <for start="1" end="$total+1">
    <a href="javascript:void(0)" page="{$i}" class="page_comment {$page == $i ? 'select' : ''}">{$i}</a>
  </for>
</div>