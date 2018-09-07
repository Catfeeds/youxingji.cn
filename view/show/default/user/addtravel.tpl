<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title>个人中心-发布</title>
    <meta name="keywords" content="{{TO->cfg key="index_keywords" group="site" default="首页"}}" />
    <meta name="description" content="{{TO->cfg key="index_description" group="site" default="首页"}}" />
    <link rel="stylesheet" href="/resource/css/module.css" />
    <link rel="stylesheet" href="/resource/css/module-less.css" />
    <link rel="stylesheet" href="/resource/css/style.css" />
    <link rel="stylesheet" href="/resource/js/layui/css/layui.css" />
    <script src="/resource/js/jquery.min.js"></script>
    <script src="/resource/js/lib.js"></script>
    <style type="text/css">
			.subbtn {
				    display: inline-block;
			    width: 112px;
			    height: 38px;
			    line-height: 38px;
			    text-align: center;
			    font-size: 16px;
			    border: none;
			    border-radius: 5px;
			    margin-right: 9px;
				background:rgba(248,89,89,1);
				color:rgba(254,254,254,1);
			}
			.sub {
				background:rgba(249,249,249,1)  !important ;
				color:rgba(102,102,102,1) !important;
			}
		</style>
</head>
 
<body>
    {{include file='public/header.tpl'}}
    <div class="main">
        <div class="ban l2" style="background-image: url(/resource/images/ban-lb1.jpg);"></div>
        <div class="wp">
           <ul class="ul-tab-lb1">
					<li class="on">
						<a href="/index.php?m=index&c=user&v=addtravel">
							<h4>发表旅行日志</h4>
							<p>用九宫格定格您的每一个动人时刻</p>
						</a>
					</li>
					<li>
						<a href="/index.php?m=index&c=user&v=addtv">
							<h4>发表旅拍TV</h4>
							<p>最原创的旅拍，最独特的旅行视角</p>
						</a>
					</li>
					<li >
						<a href="/index.php?m=index&c=user&v=travel_note">
							<h4>发表游记</h4>
							<p>用”长篇大论“记录您的美好旅程</p>
						</a>
					</li>
				</ul>           
				<style type="text/css">
                .upic {
                    display: inline-block;
                }
                .upic,.layui-upload-img {
                    width: 150px;
                    height: 150px;
                    cursor:pointer;
                    margin: 0 15px 15px 0;
                    position: relative;
                }
                .upic i {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 100px;
                    height: 100px;
                    -webkit-border-radius: 50%;
                    -moz-border-radius: 50%;
                    border-radius: 50%;
                    background: rgba(0,0,0,.2);
                    color: #fff;
                    text-align: center;
                    font-size: 24px;
                    line-height: 100px;
                    opacity: 0;
                    -webkit-transition: all .3s;
                    -moz-transition: all .3s;
                    -o-transition: all .3s;
                    transition: all .3s;
                    -o-border-radius: 50%;
                    -ms-border-radius: 50%;
                    -ms-transition: all .3s;
                }
                .upic:hover i {
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 48px;
                    height: 48px;
                    line-height: 48px;
                    opacity: 1;
                }
              	.num_text {
                    font-size: 12px;
                    color: #868686;
                    line-height: 20px;
                }
              	.num_f {
                    color: #d71618;
                }
            </style>
            <div class="m-con-lb1">
                <div class="col-l">
                    <div class="m-edit-lb">
                        <div class="tit">
                            <input type="text" class="inp" value="{{$res.title}}" id="title" placeholder="请在这里输入标题">
                        </div>
                        <div class="tit">
                            <textarea type="text" class="inp txta1" id="describe" placeholder="请在这里输入描述" style="height: 100px;line-height: 25px;padding: 10px 15px;">{{$res.describe}}</textarea>
                          	<p class="r num_text">可输入<a class="num_f" id="contentwordage">255</a>个字</p>
                        </div>
                        <div class="layui-upload">
                            <label>
                                <input type="file" name="file" class="layui-upload-file" id="myfile" style="display:none">
                            </label>
                            <blockquote class="layui-elem-quote layui-quote-nm" id="picslist" style="margin-top: 10px;{{if $res.content.0 == ''}}display:none;{{/if}}padding-bottom: 0px;width: 524px;padding-right: 0px;">
                                <div class="layui-upload-list" id="piclist">
                                    {{foreach from=$res.content item=vo}}
                                        <div class="upic" onclick="deletepic(this)"><img src="{{$vo}}" class="layui-upload-img"><i class="iz layui-icon">&#xe640;</i></div>
                                    {{/foreach}}
                                </div>
                            </blockquote>
                        </div>
                        <br>
                        <div class="fabu">
								<input type="hidden" name="did" value="{{$did}}" id="did">
								<input type="submit"  class="subbtn" id="btnAdd" value="发布">
								<input type="button"  class="sub" onclick="javascript:window.history.back(-1);"  value="取消" />
								<input type="button" class="sub"  id="btnDraft" value="保存草稿" />
								<div class="xieyi">
									<label>
			                            <input type="checkbox" checked>我已阅读并同意<a href="/article/hyzn">《游行迹协议》</a>
			                        </label>
								</div>
							</div>
                    </div>
                </div>
                <div class="col-r">
                    <div class="m-list-lb1">
                        <div class="tit">热门推荐</div>
                        <div class="m-pic2-qm">
                            <div class="slider">
                                {{vplist from='ad' item='adlist' tagname='addtravel'}}
                                <div class="item">
                                    <a href="{{$adlist.linkurl}}" target="_blank">
                                        <div class="pic">
                                            <img src="{{$adlist.imgurl}}" alt="">
                                            <span>{{$adlist.adname}}</span>
                                        </div>
                                    </a>
                                </div>
                                {{/vplist}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{include file='public/footer.tpl'}}
  	<link rel="stylesheet" href="/resource/css/slick.css">
    <script src="/resource/js/slick.min.js"></script>
    <script src="/resource/js/layui/lay/dest/layui.all.js"></script>
  	<script>
        $(document).ready(function() {
            $('.m-pic2-qm .slider').slick({
                dots: false,
                arrows: true,
                autoplay: true,
                slidesToShow: 1,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                lazyLoad: 'ondemand'
            });
        });
    </script>
    <script type="text/javascript">
      	$(document).ready(function(){
		    var limitNum = 255;
		    var num = $('.txta1').val().length;
		    var s = limitNum - num;
		    if(s < 0){
		    	$('.txta1').val(setString($('.txta1').val(),255));
		    	$('#contentwordage').html(0);
		  		return false;
		    }
		    $('#contentwordage').html(s);
		    $('.txta1').keyup(
		    	function(){
			        var remain = $(this).val().length;
			        if(remain > 255){
			        	$('.txta1').val(setString($('.txta1').val(),255));
		                var result = 0;
		            }else{
		                var result = limitNum - remain;
		            }
		            $('#contentwordage').html(result);
		        }
		    );
		});
		function setString(str, len) {  
		    var strlen = 0;  
		    var s = "";  
		    for (var i = 0; i < str.length; i++) {   
		        strlen++;   
		        s += str.charAt(i);  
		        if (strlen >= len) {  
		            return s;  
		        }  
		    }  
		    return s;  
		}
        layui.upload({
            url: "/index.php?m=api&c=index&v=uploadpic",
            type: 'image',
            ext: 'jpg|png|jpeg|bmp',
            before: function(obj){
                $('#picslist').before('<span style="color: #d71618;" class="tips">上传中...</span>');
            },
            success: function (data) {
                $('.tips').remove();
                if($('#piclist').children('.upic').length >= 9){
                    layer.msg('最多可上传9张图片');
                    return false;
                }
                $("#picslist").show();
                $('#piclist').append('<div class="upic" onclick="deletepic(this)"><img src="'+ data.url +'" class="layui-upload-img"><i class="iz layui-icon">&#xe640;</i></div>');
                jcnum();
            }
        });
        function deletepic(obj)
        {
            $(obj).remove();
            jcnum();
        }
        function jcnum()
        {
            var num = $('#piclist').children('.upic').length;
            if(num >= 9){
                $('.layui-upload-button').hide();
            }else{
                if(num == 0){
                    $("#picslist").hide();
                }else{
                    $('.layui-upload-button').show(); 
                }
            }
        }
        $('#btnAdd').click(function(){
            var title = $('#title').val();
            var did = $('#did').val();
            var describe = $('#describe').val();
            var length = $('.layui-upload-img').length;
            var list = [];
            for (var i = 0; i < length; i++) {
                list[i] = $('.layui-upload-img').eq(i).attr('src');
            }
            if(!describe){
                layer.msg('请输入描述');
                return false;
            }
            if(!list[0]){
                layer.msg('请上传图片');
                return false;
            }
            if(!$("input[type='checkbox']").is(':checked')){
                layer.msg('请选择服务协议');
                return false;
            }
            $.post("/index.php?m=api&c=index&v=addtravel", {
                'title':title,
                'list':JSON.stringify(list),
                'did':did,
                'describe':describe
            }, function(data){
                layer.msg(data.tips);
                if (data.status == 1) {
                    window.location.href = '/index.php?m=index&c=user&v=index';
                }
            },"JSON");
        })
        //保存草稿
        $('#btnDraft').click(function(){
            var title = $('#title').val();
            var describe = $('#describe').val();
            var length = $('.layui-upload-img').length;
            var list = [];
            for (var i = 0; i < length; i++) {
                list[i] = $('.layui-upload-img').eq(i).attr('src');
            }
            $.post("/index.php?m=api&c=index&v=adddraft", {
                'title':title,
                'list':JSON.stringify(list),
                'type':0,
                'describe':describe
            }, function(data){
                layer.msg(data.tips);
                if (data.status == 1) {
                    window.location.href = '/index.php?m=index&c=user&v=draft';
                }
            },"JSON");
        })
    </script>
</body>

</html>