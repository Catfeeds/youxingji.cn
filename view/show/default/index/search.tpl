<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title>搜索结果_{{TO->cfg key="site_name" group="site" default="致茂网络"}}</title>
    <meta name="description" content="{{TO->cfg key="index_keywords" group="site" default="首页"}}" />
    <meta name="keywords" content="{{TO->cfg key="index_description" group="site" default="首页"}}" />
    <link rel="stylesheet" href="/resource/css/module.css" />
    <link rel="stylesheet" href="/resource/css/module-less.css" />
    <link rel="stylesheet" href="/resource/css/style.css" />
    <script src="/resource/js/jquery.min.js"></script>
    <script src="/resource/js/lib.js"></script>
</head>

<body>
    {{include file='public/header.tpl'}}
    <div class="main">
      	<div class="sj">
          	<p>搜索结果</p>
      	</div>
      	<div class="wp lis">
          	<span>以下是为您找到“{{$keyword}}”相关结果{{$num}}条</span>
          	<div class="left-s">
              	<!--日阅潭-->
              	{{if $ryt}}
                <div class="clearfix ser-title">
                    <h2>
                        <a href="javascript:;" class="_j_search_link">日阅潭</a>
                    </h2>
                    <a href="/index.php?m=index&c=index&v=searchmore&type=ryt&keyword={{$keyword}}" class="_j_search_link" data-is-redirect="1">更多日阅潭 &gt;&gt;</a>
                </div>
                {{foreach from=$ryt item=vo}}
                <li>
                  	<div class="flt1">
                      	<a href="/index.php?m=index&c=index&v=rytdetai&id={{$vo.id}}" target="_blank" style="margin-bottom: 0px;"><img src="{{$vo.pics}}" style="width:135px;height:85px;"></a>
                  	</div>
                  	<div class="ct-text">
                        <a href="/index.php?m=index&c=index&v=rytdetai&id={{$vo.id}}" target="_blank">{{$vo.title}}</a>
                        <p>{{$vo.content}}</p>
                        <ul class="seg-info-list clearfix">
                            <span>浏览({{$vo.shownum}})</span><span> {{$vo.addtime}}</span>
                        </ul>
                    </div>
                </li>
                {{/foreach}}
              	{{/if}}
              	<!--甄选之旅-->
              	{{if $journey}}
              	<div class="clearfix ser-title top">
                    <h2>
                        <a href="javascript:;" class="_j_search_link">甄选之旅</a>
                    </h2>
                </div>
                {{foreach from=$journey item=vo}}
                <div class="exe-packg01">
                    <ul class="clearfix">
                        <li>
                            <div class="flt1">
                                <a href="/index.php?m=index&c=index&v=journeydetail&id={{$vo.id}}" target="_blank" class="_j_search_link">
                                	<img src="{{$vo.extend.tjpic}}" style="width:90px;height:90px;">
                              	</a>
                            </div>
                            <div class="dwn-nr">
                              	<p class="seg-desc"><a href="/index.php?m=index&c=index&v=journeydetail&id={{$vo.id}}" target="_blank" class="_j_search_link">{{$vo.title}}</a></p>
                                <h5>
                                    <a href="/index.php?m=index&c=index&v=journeydetail&id={{$vo.id}}" target="_blank" class="seg-price _j_search_link">¥{{$vo.extend.price}}</a>
                                </h5>
                            </div>
                        </li>
                    </ul>
                </div>
                {{/foreach}}
              	{{/if}}
              	<!--达人邦-->
              	{{if $star}}
              	<div class="clearfix ser-title top">
                    <h2>
                        <a href="javascript:;" class="_j_search_link">达人邦</a>
                    </h2>
                  	<a href="/index.php?m=index&c=index&v=searchmore&type=star&keyword={{$keyword}}" class="_j_search_link" data-is-redirect="1">更多达人邦 &gt;&gt;</a>
                </div>
              	<div class="travel-notes _j_search_section" data-category="info">
                  <ul>
                      {{foreach from=$star item=vo}}
                      <li>
                          <p class="clearfix">
                              <a href="{{$vo.uid|helper:'href'}}" target="_blank" class="_j_search_link">{{$vo.title}}</a>
                              <span class="seg-info">{{$vo.addtime}}</span>
                              <span class="seg-info">{{$vo.uid|helper:'username'}}</span>
                              <span class="seg-info">浏览({{$vo.shownum}})</span>
                              <span class="seg-info">点赞({{$vo.topnum}})</span>
                          </p>
                      </li>
                      {{/foreach}}
                  </ul>
              	</div>
              	{{/if}}
              	<!--旅拍TV-->
              	{{if $tv}}
              	<div class="clearfix ser-title top">
                    <h2>
                        <a href="javascript:;" class="_j_search_link">旅拍TV</a>
                    </h2>
                  	<a href="/index.php?m=index&c=index&v=searchmore&type=tv&keyword={{$keyword}}" class="_j_search_link" data-is-redirect="1">更多旅拍TV &gt;&gt;</a>
                </div>
              	<div class="travel-notes _j_search_section" data-category="info">
                  <ul>
                      {{foreach from=$tv item=vo}}
                      <li>
                          <p class="clearfix">
                              <a href="/index.php?m=index&c=muser&v=tv&id={{$vo.uid}}" target="_blank" class="_j_search_link">{{$vo.title}}</a>
                              <span class="seg-info">{{$vo.addtime}}</span>
                              <span class="seg-info">{{$vo.uid|helper:'username'}}</span>
                              <span class="seg-info">浏览({{$vo.shownum}})</span>
                              <span class="seg-info">点赞({{$vo.topnum}})</span>
                          </p>
                      </li>
                      {{/foreach}}
                  </ul>
              	</div>
              	{{/if}}
              	<!--作家-->
              	{{if $writer}}
                <div class="clearfix ser-title">
                    <h2>
                        <a href="javascript:;" class="_j_search_link">作家</a>
                    </h2>
                    <a href="/index.php?m=index&c=index&v=searchmore&type=writer&keyword={{$keyword}}" class="_j_search_link" data-is-redirect="1">更多作家 &gt;&gt;</a>
                </div>
                {{foreach from=$writer item=vo}}
                <li>
                  	<div class="flt1">
                      	<a href="/index.php?m=index&c=index&v=writer&id={{$vo.id}}" target="_blank" style="margin-bottom: 0px;"><img src="{{$vo.pics}}" style="width:135px;"></a>
                  	</div>
                  	<div class="ct-text">
                        <a href="/index.php?m=index&c=index&v=writer&id={{$vo.id}}" target="_blank">{{$vo.name}}</a>
                        <p>{{$vo.introduction}}</p>
                    </div>
                </li>
                {{/foreach}}
              	{{/if}}
          	</div>
          	{{if $userlist}}
          	<div class="ser-rt" style="margin-bottom: 10px;">
              	<!--用户-->
          		<div class="_j_search_section" data-category="user">
                    <div class="clearfix ser-title">
                        <h2>
                        <a href="javascript:;" class="_j_search_link" data-is-redirect="1">用户</a>
                        </h2>
                        <a href="/index.php?m=index&c=index&v=searchmore&type=user&keyword={{$keyword}}" class="_j_search_link" data-is-redirect="1">更多用户 &gt;&gt;</a>
                    </div>
                    <ul class="user-list-row">
                      	{{foreach from=$userlist item=vo}}
                        <li>
                            <div class="btns">
                                <a class="btn-follow _j_user_follow" href="javascript:;" onclick="follows({{$vo.uid}},this)">{{$vo.uid|helper:'isfollows'}}</a>
                                <a class="btn-msg _j_user_letter" href="{{$vo.uid|helper:'href'}}" target="_blank">私信</a>
                            </div>
                            <span class="avatar"><a href="{{$vo.uid|helper:'href'}}" target="_blank" class="_j_search_link"><img src="{{$vo.avatar}}" title="{{$vo.username}}" style="width:45px;height:45px;"></a></span>
                            <div class="base">
                                <span class="name"><a href="{{$vo.uid|helper:'href'}}" target="_blank" class="_j_search_link">{{$vo.username}}</a></span>
                                <a class="grade" href="{{$vo.uid|helper:'href'}}">{{$vo.lvname}}</a>
                            </div>
                            <div class="nums">
                                <a href="/index.php?m=index&c=muser&v=follow&id={{$vo.uid}}" target="_blank" class="_j_search_link">关注：{{$vo.uid|helper:'follownum'}}</a>
                                <a href="/index.php?m=index&c=muser&v=fans&id={{$vo.uid}}" target="_blank" class="_j_search_link">粉丝：{{$vo.uid|helper:'fansnum'}}</a>
                                <a href="/index.php?m=index&c=muser&v=visitor&id={{$vo.uid}}" target="_blank" class="_j_search_link">访客：{{$vo.uid|helper:'visitor'}}</a>
                            </div>
                        </li>
                      	{{/foreach}}
                    </ul>
                </div>
          	</div>
          	{{/if}}
      	</div>
      	<div class="wp">
            <!-- 页码 -->
            {{if $multipage}}
            <div class="pages" style="text-align: left;padding-top: 20px;padding-bottom: 20px;">
              <ul>
                {{foreach from=$multipage item=page}}
                <li {{if $page.2}}class="{{$page.2}}"{{/if}}><a href="{{$page.1}}">{{$page.0}}</a></li>
                {{/foreach}}
                <li class="pages-form">
                  到<input class="inp" type="text" id="pages">页
                  <input class="btn" type="button" id="pageqr" value="确定">
                </li>
              </ul>
            </div>
            {{/if}}
            <!-- 页码 end-->
        </div>
    </div>
    {{include file='public/footer.tpl'}}
  	<script src="/resource/js/layui/lay/dest/layui.all.js"></script>
    <script type="text/javascript">
        function follows(bid, obj)
        {
            $.post("/index.php?m=api&c=index&v=follow", {
                'bid':bid
            }, function(data){
                if(data.status == 0){
                    layer.msg(data.tips);
                }else if(data.status == 1){
                    $(obj).html('已关注');
                }else if(data.status == 2){
                    $(obj).html('<b>+</b> 关注');
                }
            },"JSON");
        }
    </script>
  	<script>
  		$('#pageqr').click(function(){
            var page = $('#pages').val();
            if(page){
                window.location.href = "/index.php?m=index&c=index&v=search&keyword={{$keyword}}&page=" + page;
            }
        })
  	</script>
</body>

</html>