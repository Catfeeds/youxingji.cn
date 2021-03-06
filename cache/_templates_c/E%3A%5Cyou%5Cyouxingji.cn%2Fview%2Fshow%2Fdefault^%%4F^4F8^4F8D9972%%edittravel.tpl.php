<?php /* vpcvcms compiled created on 2018-11-07 10:08:55
         compiled from user/edittravel.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title>个人中心-编辑</title>
    <meta name="keywords" content="<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'index_keywords','group' => 'site','default' => "首页"), $this);?>
" />
    <meta name="description" content="<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'index_description','group' => 'site','default' => "首页"), $this);?>
" />
    <link rel="stylesheet" href="/resource/css/module.css" />
    <link rel="stylesheet" href="/resource/css/module-less.css" />
    <link rel="stylesheet" href="/resource/css/style.css" />
    <link rel="stylesheet" href="/resource/layui/css/layui.css" />
    <script src="/resource/js/jquery.min.js"></script>
    <script src="/resource/js/lib.js"></script>
</head>
<body>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div class="main">
        <div class="ban l2" style="background-image: url(/resource/images/ban-lb1.jpg);"></div>
        <div class="wp">
            <ul class="ul-tab-lb1">
               <li class="on">
						<a href="/index.php?m=index&c=user&v=addtravel">
							<h4>编辑旅行日志</h4>
							<p>用九宫格定格您的每一个动人时刻</p>
						</a>
					</li>
            </ul>
            <style type="text/css">
				#piclist .upic:first-child .left{display: none;}
				#piclist .upic:last-child  .right{display: none;}
				
                .upic {display: inline-block;}
                .upic,.layui-upload-img{width: 150px;height: 150px;cursor:pointer;margin: 0 15px 15px 0;position: relative;}
                
                .upic i{position: absolute;transform: translate(-50%, -50%);width: 100px;height: 100px;
	                    -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;background: rgba(0,0,0,.2);
	                    color: #fff;text-align: center;font-size: 24px;line-height: 100px;opacity: 0;
	                    -webkit-transition: all .3s;-moz-transition: all .3s;-o-transition: all .3s;
	                    transition: all .3s;-o-border-radius: 50%;-ms-border-radius: 50%;-ms-transition: all .3s;}
	            .upic i:nth-of-type(1){bottom: 0%;right: 78px;}
                .upic i:nth-of-type(2){bottom: 0%;right: 28px;}
                .upic i:nth-of-type(3){bottom: 0%;right: -24px;}
                
                .upic:hover i{bottom: 0%;transform: translate(-50%, -50%);width: 48px;height: 48px;line-height: 48px;opacity: 1;}
                
                .upic:hover i:nth-of-type(1){right: 78px;}
                .upic:hover i:nth-of-type(2){right: 28px;}
                .upic:hover i:nth-of-type(3){right: -24px;}
              	
              	.num_text {font-size: 12px;color: #868686;line-height: 20px;}
              	.num_f {color: #d71618;}
            </style>
            <div class="m-con-lb1">
                <div class="col-l">
                    <div class="m-edit-lb">
                        <div class="tit"><input type="text" class="inp" value="<?php echo $this->_tpl_vars['res']['title']; ?>
" id="title" placeholder="请在这里输入标题"></div>
                        <div class="tit">
                            <textarea type="text" class="inp txta1" id="describe" placeholder="请在这里输入描述" style="height: 100px;line-height: 25px;padding: 10px 15px;"><?php echo $this->_tpl_vars['res']['describes']; ?>
</textarea>
                          	<p class="r num_text">可输入<a class="num_f" id="contentwordage">255</a>个字</p>
                        </div>
                        <div class="layui-upload">
                        	<button type="button" class="layui-btn" id="layui_upload_icon"><i class="layui-icon">&#xe67c;</i>上传图片</button>
                            <label><input type="file" name="file" class="layui-upload-file" id="myfile" style="display:none"></label>
                            <blockquote class="layui-elem-quote layui-quote-nm" id="picslist" style="margin-top: 10px;<?php if ($this->_tpl_vars['res']['content']['0'] == ''): ?>display:none;<?php endif; ?>padding-bottom: 0px;width: 524px;padding-right: 0px;">
                                <div class="layui-upload-list" id="piclist">
                                    <?php $_from = $this->_tpl_vars['res']['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
                                        <div class="upic">
	                                    	<img src="<?php echo $this->_tpl_vars['vo']; ?>
" class="layui-upload-img">
	                                    	<i class="iz layui-icon left" onclick="leftpic(this)">&#xe603;</i>
	                                    	<i class="iz layui-icon" onclick="deletepic(this)">&#xe640;</i>
	                                    	<i class="iz layui-icon right" onclick="rightpic(this)">&#xe602;</i>
	                                    </div>
                                    <?php endforeach; endif; unset($_from); ?>
                                </div>
                            </blockquote>
                        </div>
                      	<div class="xieyi"></div>
                        <div class="fabu"><input type="submit" class="sub" id="btnAdd" value="保存"></div>
                    </div>
                </div>
                <div class="col-r">
                    <div class="m-list-lb1">
                        <div class="tit">热门推荐</div>
                        <div class="m-pic2-qm">
                            <div class="slider">
                                <?php $_from = C::T('ad')->getList(array('tagname' => 'addtravel'));if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['adlist']):
?>
                                <div class="item">
                                    <a href="<?php echo $this->_tpl_vars['adlist']['linkurl']; ?>
" target="_blank">
                                        <div class="pic">
                                            <img src="<?php echo $this->_tpl_vars['adlist']['imgurl']; ?>
" alt="">
                                            <span><?php echo $this->_tpl_vars['adlist']['adname']; ?>
</span>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; endif; unset($_from); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  	<link rel="stylesheet" href="/resource/css/slick.css">
    <script src="/resource/js/slick.min.js"></script>
    <script src="/resource/layui/layui.all.js"></script>
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
		
		layui.use('upload', function(){
			var upload = layui.upload;
			
			//执行实例
			var uploadInst = upload.render({
			    elem: '#layui_upload_icon' //绑定元素
			    ,url: '/index.php?m=api&c=index&v=uploadpic' //上传接口
			    ,type: 'image'
            	,ext: 'jpg|png|jpeg|bmp'
			    ,multiple: true //开启多文件上传
			    ,number:9
			    ,allDone: function(obj){ //当文件全部被提交后，才触发
				    //console.log(obj.total); //得到总文件数
				    //console.log(obj.successful); //请求成功的文件数
				    //console.log(obj.aborted); //请求失败的文件数
				}
			    ,before: function(obj){
			    	layer.load(); //上传loading
	        	}
			    ,done: function(res){
			    	if($('#piclist').children('.upic').length >= 9){
	                    layer.closeAll('loading'); //关闭loading
	                    layer.msg('最多可上传9张图片');
	                    return false;
	                }
	                $("#picslist").show();
	                var html  = '<div class="upic">'+
	                				'<img src="'+ res.url +'" class="layui-upload-img">'+
	                				'<i class="iz layui-icon left" onclick="leftpic(this)">&#xe603;</i>'+
                                   	'<i class="iz layui-icon" onclick="deletepic(this)">&#xe640;</i>'+
                                    '<i class="iz layui-icon right" onclick="rightpic(this)">&#xe602;</i>'+
	                			'</div>';
	                $('#piclist').append(html);
	                //$('#piclist').append('<div class="upic" onclick="deletepic(this)"><img src="'+ res.url +'" class="layui-upload-img"><i class="iz layui-icon">&#xe640;</i></div>');
	                jcnum();
			    	//上传完毕回调
			    	layer.closeAll('loading'); //关闭loading
			    }
			    ,error: function(){
			    	//请求异常回调
			    	layer.closeAll('loading'); //关闭loading
			    }
			});
		});

        //往左移动
        function leftpic(obj){
            var src1 = $(obj).siblings("img").attr("src");
            var src2 = $(obj).parent().prev().children("img").attr("src");
            $(obj).siblings("img").attr("src",src2);
            $(obj).parent().prev().children("img").attr("src",src1);
        }
        //往右移动
    	function rightpic(obj){
            var src1 = $(obj).siblings("img").attr("src");
            var src2 = $(obj).parent().next().children("img").attr("src");
            $(obj).siblings("img").attr("src",src2);
            $(obj).parent().next().children("img").attr("src",src1);
        }

		//删除图片
        function deletepic(obj){
            $(obj).remove();
            jcnum();
        }
        function jcnum(){
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
        //发布
        $('#btnAdd').click(function(){
            var title = $('#title').val();
            var id = <?php echo $this->_tpl_vars['id']; ?>
;
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
            $.post("/index.php?m=api&c=index&v=edittravel", {
                'title':title,
                'list':JSON.stringify(list),
                'id':id,
                'describe':describe
            }, function(data){
                layer.msg(data.tips);
                if (data.status == 1) {
                    window.location.href = '/index.php?m=index&c=user&v=index';
                }
            },"JSON");
        });
    </script>
</body>
</html>