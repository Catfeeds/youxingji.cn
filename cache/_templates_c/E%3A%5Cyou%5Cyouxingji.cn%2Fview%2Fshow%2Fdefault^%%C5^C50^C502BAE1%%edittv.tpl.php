<?php /* vpcvcms compiled created on 2018-07-26 10:11:41
         compiled from user/edittv.tpl */ ?>
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
    <link rel="stylesheet" href="/resource/js/layui/css/layui.css" />
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
                    <a href="javascript:;">
                        <h4>编辑旅拍TV</h4>
                       <p>最原创的旅拍，最独特的旅行视角</p>
                    </a>
                </li>
            </ul>
            <style type="text/css">
                .upic {
                    max-width: 300px;
                    margin-top: 20px;
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
                            <input type="text" class="inp" value="<?php echo $this->_tpl_vars['res']['title']; ?>
" id="title" placeholder="请在这里输入标题">
                        </div>
                        <div class="tit">
                            <textarea type="text" class="inp txta1" id="describe" placeholder="请在这里输入描述" style="height: 100px;line-height: 25px;padding: 10px 15px;"><?php echo $this->_tpl_vars['res']['describes']; ?>
</textarea>
                          	<p class="r num_text">可输入<a class="num_f" id="contentwordage">255</a>个字</p>
                        </div>
                        <div class="tit">
                            <input type="text" class="inp" value="<?php echo $this->_tpl_vars['res']['url']; ?>
" id="url" placeholder="请在这里输入优酷视频地址">
                        </div>
                        <div class="layui-upload">
                            <label>
                                <input type="file" name="file" class="layui-upload-file" id="myfile" style="display:none">
                            </label>
                            <div class="layui-upload-list" id="piclist">
                                <?php if ($this->_tpl_vars['res']['pics'] != ''): ?>
                                <div class="upic"><img src="<?php echo $this->_tpl_vars['res']['pics']; ?>
" class="layui-upload-img"></div>
                                <?php else: ?>
                                <div class="upic"><img src="" class="layui-upload-img"></div style="display: none">
                                <?php endif; ?>
                            </div>
                        </div>
                        <!--<ul class="upload-ul clearfix">
							<li class="upload-pick">
								<div class="webuploader-container clearfix" id="goodsUpload"></div>
							</li>
						</ul>
						<p>
							<a class="upload-btn" href="javascript:;">提交</a>
						</p>-->
                        <div class="xieyi">
                            
                        </div>
                        <div class="fabu">
                            <input type="submit" class="sub" id="btnAdd" value="保存">
                        </div>
                    </div>
                </div>
                <div class="col-r">
                    <div class="m-list-lb1">
                        <div class="tit">热门推荐</div>
                        <div class="m-pic2-qm">
                            <div class="slider">
                                <?php $_from = C::T('ad')->getList(array('tagname' => 'addtv'));if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                $('#piclist').html('<div class="upic"><img src="'+ data.url +'" class="layui-upload-img"></div>');
            }
        });
        $('#btnAdd').click(function(){
            var title = $('#title').val();
            var describe = $('#describe').val();
            var url = $('#url').val();
            var id = <?php echo $this->_tpl_vars['id']; ?>
;
            var pic = $('.layui-upload-img').attr('src');
            if(!describe){
                layer.msg('请输入描述');
                return false;
            }
            if(!url){
                layer.msg('请输入视频地址');
                return false;
            }
            if(!pic){
                layer.msg('请上传图片');
                return false;
            }
            $.post("/index.php?m=api&c=index&v=edittv", {
                'title':title,
                'url':url,
                'pic':pic,
                'id':id,
                'describe':describe
            }, function(data){
                layer.msg(data.tips);
                if (data.status == 1) {
                    window.location.href = window.location.href;
                }
            },"JSON");
        })
    </script>
</body>

</html>