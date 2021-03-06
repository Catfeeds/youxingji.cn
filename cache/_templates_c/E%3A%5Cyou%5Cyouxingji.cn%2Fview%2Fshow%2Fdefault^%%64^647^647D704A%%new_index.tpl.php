<?php /* vpcvcms compiled created on 2018-10-22 15:40:52
         compiled from wap/user/new_index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'helper', 'wap/user/new_index.tpl', 45, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title>个人中心</title> 
    <meta name="keywords" content="<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'index_keywords','group' => 'site','default' => "首页"), $this);?>
" />
    <meta name="description" content="<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'index_description','group' => 'site','default' => "首页"), $this);?>
" />
    <link rel="stylesheet" href="/resource/m/css/style.css" />
    <script src="/resource/m/js/jquery.js"></script> 
    <script src="/resource/m/js/lib.js"></script>
</head> 
<body class="">
    <div class="header">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'wap/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <h3>个人中心</h3>
    </div>
    <div class="mian">
        <div class="g-top">
            <div class="logo"><a href="/"><img src="/resource/m/images/logo.png" alt="" /></a></div>
            <div class="so">
                <form action="/index.php">
                    <input type="hidden" name="m" value="wap"/>
                    <input type="hidden" name="c" value="index"/>
                    <input type="hidden" name="v" value="search"/>
                    <input type="text" name="keyword" placeholder="请输入关键字" class="inp" />
                    <input type="submit" value="" class="sub" />
                </form>
            </div>
        </div>
        <div class="ban ban1">
            <a class="dis_block fix" href="">
		        <img class="headPortrait" src="<?php echo $this->_tpl_vars['user']['avatar']; ?>
" alt="">
		    </a>
		    <div class="content fix">
		    	<p class="wx_name"><?php echo $this->_tpl_vars['user']['username']; ?>
</p>
		    	<p class="middle"><span class="grade">等级：<i><?php echo $this->_tpl_vars['user']['lvname']; ?>
</i></span> <span class="dwell">现居：<i><?php echo $this->_tpl_vars['user']['city']; ?>
</i></span></p>
		    	<p class="signature" title="个性签名"><?php echo $this->_tpl_vars['user']['autograph']; ?>
</p>
		    </div>
		    <ul class="ul-txtlist-yz ClassUL">
                <li><a href="/index.php?m=wap&c=user&v=follow">
    					<i><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['uid'])) ? $this->_run_mod_handler('helper', true, $_tmp, 'follownum') : smarty_modifier_helper($_tmp, 'follownum')); ?>
</i>
    					<div class="txt">关注</div>
    				</a>
                </li>
                <li><a href="/index.php?m=wap&c=user&v=fans">
    					<i><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['uid'])) ? $this->_run_mod_handler('helper', true, $_tmp, 'fansnum') : smarty_modifier_helper($_tmp, 'fansnum')); ?>
</i>
    					<div class="txt">粉丝</div>
    				</a>
                </li>
                <li><a href="/index.php?m=wap&c=user&v=visitor">
    					<i><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['uid'])) ? $this->_run_mod_handler('helper', true, $_tmp, 'visitor') : smarty_modifier_helper($_tmp, 'visitor')); ?>
</i>
    					<div class="txt">访客</div>
    				</a>
                </li>
        	</ul>
        </div>
        <div class="row-yz">
            <div class="m-nv-yz" style="border-bottom: none;">
                <a class="dis_block fix" href="index.php?m=wap&c=user&v=msg">
	                <p class="level news">
	                	<img class="" src="/resource/m/images/user/0.png"/>消息
	                	<img class="RightArrows" src="/resource/m/images/user/8.png" />
                        <?php if ($this->_tpl_vars['msg_total']): ?>
                            <span class="amount"><?php echo $this->_tpl_vars['msg_total']; ?>
</span>
                        <?php endif; ?>
	                </p>
	            </a>
            </div>
        </div>
        <div class="row-yz" style="margin-bottom: 11px;">
            <ul class="ul-txtlist-yz borderNone" style="border: none;">
                <li><a href="/index.php?m=wap&c=user&v=addtravel">
    					<i style="background-image: url(/resource/m/images/s-i5.png);"></i>
    					<div class="txt">发布日志</div>
    				</a>
                </li>
                <li><a href="/index.php?m=wap&c=user&v=addtv">
    					<i style="background-image: url(/resource/m/images/s-i2.png);"></i>
    					<div class="txt">发布视频</div>
    				</a>
                </li>
                <li><a href="/index.php?m=wap&c=user&v=add_note">
    					<i style="background-image: url(/resource/m/images/s-i1.png);"></i>
    					<div class="txt">发布游记</div>
    				</a>
                </li>
                <li><a href="/index.php?m=wap&c=faq&v=set_faq">
    					<i style="background-image: url(/resource/m/images/s-i4.png);"></i>
    					<div class="txt">发布提问</div>
    				</a>
                </li>
            </ul>
        </div>
        <div class="row-yz">
            <div class="m-nv-yz heightAuto" style="border-bottom: none;">
                <div class="level">
                	<a class="dis_block fix" href="/index.php?m=wap&c=user&v=travel">
	                	<img class="" src="/resource/m/images/user/1.png"/>
	                	<p class="">我的日志<img class="RightArrows" src="/resource/m/images/user/8.png" /></p>
                	</a>
                </div>
                <div class="level">
                	<a class="dis_block fix" href="/index.php?m=wap&c=user&v=tv">
	                	<img class="" src="/resource/m/images/user/2.png"/>
	                	<p class="">我的视频<img class="RightArrows" src="/resource/m/images/user/8.png" /></p>
                	</a>
                </div>
                <div class="level">
                	<a class="dis_block fix" href="/index.php?m=wap&c=user&v=travel_note">
	                	<img class="" src="/resource/m/images/user/3.png"/>
	                	<p class="">我的游记<img class="RightArrows" src="/resource/m/images/user/8.png" /></p>
                	</a>
                </div>
                <div class="level">
                	<a class="dis_block fix" href="/index.php?m=wap&c=user&v=my_faq">
	                	<img class="" src="/resource/m/images/user/4.png"/>
	                	<p class="">我的问答<img class="RightArrows" src="/resource/m/images/user/8.png" /></p>
                	</a>
                </div>
                <div class="level">
                	<a class="dis_block fix" href="/index.php?m=wap&c=collection&v=collection_travel">
	                	<img class="" src="/resource/m/images/user/5.png"/>
	                	<p class="">我的收藏<img class="RightArrows" src="/resource/m/images/user/8.png" /></p>
                	</a>
                </div>
                <div class="level">
                	<a class="dis_block fix" href="/index.php?m=wap&c=user&v=draft">
	                	<img class="" src="/resource/m/images/user/6.png"/>
	                	<p class="">草稿箱<img class="RightArrows" src="/resource/m/images/user/8.png" /></p>
                	</a>
                </div>
                <div class="level">
                	<a class="dis_block fix" href="/index.php?m=wap&c=user&v=setting">
	                	<img class="" src="/resource/m/images/user/7.png"/>
	                	<p class="">设置<img class="RightArrows" src="/resource/m/images/user/8.png" /></p>
                	</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    	window.onload=function(){
    		//判断个人中心 【个性签名】内容的长度，如果长度不足够，说明此标签的高度小于17px,字体居中
    		var signature= parseInt($(".signature").get(0).offsetHeight);
    		if (signature <= 17 ) {
    			$(".signature").css("text-align","center");
    		} else{
    			$(".signature").css("text-align","justify");
    		}
    	}
    </script>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'wap/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>