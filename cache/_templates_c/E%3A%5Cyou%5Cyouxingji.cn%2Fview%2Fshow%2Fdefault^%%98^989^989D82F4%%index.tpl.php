<?php /* vpcvcms compiled created on 2018-07-10 11:01:59
         compiled from wap/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'helper', 'wap/index.tpl', 176, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		<meta name="renderer" content="webkit" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
		<meta name="format-detection" content="telephone=no" />
		<title><?php echo Core_Config::get('index_seotitle', 'site', '首页');?>_<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'site_name','group' => 'site','default' => "致茂网络"), $this);?>
</title>
		<meta name="keywords" content="<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => ' index_keywords ','group' => 'site ','default' => "首页 "), $this);?>
" />
		<meta name="description" content="<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => ' index_description ','group' => 'site ','default' => "首页 "), $this);?>
" />
		<link rel="stylesheet" href="/resource/m/css/style.css" />

		<style type="text/css">
			.title {
				color: #000000;
				margin: 10px 0;
				font-size: 14px;
				font-weight: bold;
			}
			
			.txt div p span {
				color: #999 !important;
				font-size: 10px !important;
			}
		</style>
		<script src="/resource/lightbox/jquery.min.js"></script>
		<script src="/resource/m/js/lib.js"></script>
		<!--lightbox开始-->
		<link rel="stylesheet" type="text/css" href="/resource/lightbox/jquery.lightbox.css" />
		<!--[if IE 6]>
 	<link rel="stylesheet" type="text/css" href="/resource/lightbox/jquery.lightbox.ie6.css" />
	<![endif]-->
		<script type="text/javascript" src="/resource/lightbox/jquery.lightbox.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.lightbox').lightbox();
			});
		</script>
	</head>

	<body class="index">
		<div class="header">
			<div class="logo">
				<a href=""><img src="/resource/m/images/logo.png" alt="" /></a>
			</div>
			<?php if (! $this->_tpl_vars['user']): ?>
			<a href="/index.php?m=wap&c=index&v=login" class="sign">登录</a>
			<?php else: ?>
			<a href="/index.php?m=wap&c=user&v=index" class="sign">会员</a>
			<?php endif; ?>
			<div class="so">
				<form action="/index.php">
					<input type="hidden" name="m" value="wap" />
					<input type="hidden" name="c" value="index" />
					<input type="hidden" name="v" value="search" />
					<input type="text" name="keyword" placeholder="请输入关键字" class="inp" />
					<input type="submit" value="" class="sub" />
				</form>
			</div>
		</div>
		<div class="mian" style="margin-top: 0px;">
			<div class="banner swiper-container">
				<div class="swiper-wrapper">
					<?php $_from = C::T('ad')->getList(array('tagname' => 'waphomeslide'));if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['adlist']):
?>
					<div class="swiper-slide">
						<a href="javascript:;">
							<div class="pic">
								<img src="<?php echo $this->_tpl_vars['adlist']['imgurl']; ?>
" alt="" />
							</div>
						</a>
					</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				<div class="swiper-pagination"></div>
				<div class="wp">
					<div class="txt">
						<img src="/resource/m/images/q-icon12.png" alt="" />
						<h2><?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'site_add_homebannertxt','group' => 'site','default' => ""), $this);?>
</h2>
					</div>
				</div>
			</div>
			<ul class="ul-imgtxt1">
				<li>
					<a href="/index.php?m=wap&c=swim&v=index">
						<i style="background-image: url(/resource/m/images/q-icon01.png);"></i>
						<span>游主张</span>
					</a>
				</li>
				<li>
					<a href="/index.php?m=wap&c=index&v=journey">
						<i style="background-image: url(/resource/m/images/q-icon14.png);"></i>
						<span>甄选之旅</span>
					</a>
				</li>
				<li>
					<a href="/index.php?m=wap&c=index&v=star">
						<i style="background-image: url(/resource/m/images/q-icon15.png);"></i>
						<span>达人邦</span>
					</a>
				</li>
				<li>
					<a href="/index.php?m=wap&c=index&v=scenery">
						<i style="background-image: url(/resource/m/images/q-icon16.png);"></i>
						<span>游画</span>
					</a>
				</li>
				<li>
					<a href="/index.php?m=wap&c=index&v=tv">
						<i style="background-image: url(/resource/m/images/q-icon17.png);"></i>
						<span>旅拍TV</span>
					</a>
				</li>
				<li>
					<a href="/index.php?m=wap&c=index&v=ryt">
						<i style="background-image: url(/resource/m/images/q-icon18.png);"></i>
						<span>日阅潭</span>
					</a>
				</li>
				<li>
					<a href="/index.php?m=wap&c=index&v=mxp">
						<i style="background-image: url(/resource/m/images/q-icon19.png);"></i>
						<span>玩转明信片</span>
					</a>
				</li>
				<li>
					<a href="/index.php?m=wap&c=user&v=index">
						<i style="background-image: url(/resource/m/images/q-icon20.png);"></i>
						<span>个人中心</span>
					</a>
				</li>
			</ul>
			<div class="index-row1">
				<div class="wp">
					<h3 class="g-tit1">游主张</h3>
					<div class="m-imgtxt1 swiper-container">
						<a href="index.php?m=wap&c=swim&v=index"><img src="/resource/images/mobile_swim.jpg"/></a>
					</div>
				</div>
			</div>
			<div class="index-row1">
				<div class="wp">
					<h3 class="g-tit1">甄选之旅</h3>
					<div class="m-imgtxt1 swiper-container">
						<div class="swiper-wrapper">
							<?php $_from = C::T('ad')->getList(array('tagname' => 'waphomeo1'));if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['adlist']):
?>
							<div class="swiper-slide">
								<a href="<?php echo $this->_tpl_vars['adlist']['linkurl']; ?>
">
									<div class="pic">
										<img src="<?php echo $this->_tpl_vars['adlist']['imgurl']; ?>
" alt="" />
										<div class="txt">
											<h3><?php echo $this->_tpl_vars['adlist']['adname']; ?>
</h3>
										</div>
									</div>
								</a>
							</div>
							<?php endforeach; endif; unset($_from); ?>
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</div>
			</div>
			
			<div class="index-row2">
				<div class="wp">
					<h3 class="g-tit1">达人邦</h3>
					<ul class="ul-list-talent">
						<?php $_from = $this->_tpl_vars['starlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
						<li>
							<div class="item">
								<div class="info">
									<span class="date"><?php echo $this->_tpl_vars['vo']['addtime']; ?>
</span>
									<div class="tx">
										<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['uid'])) ? $this->_run_mod_handler('helper', true, $_tmp, 'mhref') : smarty_modifier_helper($_tmp, 'mhref')); ?>
" class="pic"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['uid'])) ? $this->_run_mod_handler('helper', true, $_tmp, 'avatar') : smarty_modifier_helper($_tmp, 'avatar')); ?>
" alt=""></a>
										<h5><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['uid'])) ? $this->_run_mod_handler('helper', true, $_tmp, 'mhref') : smarty_modifier_helper($_tmp, 'mhref')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['uid'])) ? $this->_run_mod_handler('helper', true, $_tmp, 'username') : smarty_modifier_helper($_tmp, 'username')); ?>
</a></h5>
									</div>
									<div class="c"></div>
									<div class="txt">
										<p><?php echo $this->_tpl_vars['vo']['describes']; ?>
</p>
									</div>
								</div>
								<dl class="list-img">
									<?php $_from = $this->_tpl_vars['vo']['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
									<dd>
										<a href="<?php echo $this->_tpl_vars['v']; ?>
" class="lightbox" rel="list<?php echo $this->_tpl_vars['vo']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['v']; ?>
" alt=""></a>
									</dd>
									<?php endforeach; endif; unset($_from); ?>
								</dl>
								<div class="other">
									<span class="eye-c" style="background-image: url(/resource/m/images/i-eye.png)"><?php echo $this->_tpl_vars['vo']['shownum']; ?>
</span>
									<span class="zan-c zan" style="background-image: url(/resource/m/images/i-zan.png)" data-id="<?php echo $this->_tpl_vars['vo']['id']; ?>
" data-num="<?php echo $this->_tpl_vars['vo']['topnum']; ?>
"><a id="zan<?php echo $this->_tpl_vars['vo']['id']; ?>
"><?php echo $this->_tpl_vars['vo']['topnum']; ?>
</a></span>
								</div>
							</div>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<a href="/index.php?m=wap&c=index&v=star" class="g-more1">查看更多</a>
				</div>
			</div>
			<div class="index-row3">
				<?php $_from = C::T('ad')->getList(array('tagname' => 'waphomeo2'));if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['adlist']):
?>
				<div class="pic">
					<a href="<?php echo $this->_tpl_vars['adlist']['linkurl']; ?>
"><img src="<?php echo $this->_tpl_vars['adlist']['imgurl']; ?>
" alt="" /></a>
				</div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<div class="index-row4">
				<h3 class="g-tit1">游画</h3>
				<div class="m-imgtxt2 swiper-container">
					<div class="swiper-wrapper">
						<?php $_from = $this->_tpl_vars['scenery']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<div class="swiper-slide">
							<a href="<?php echo $this->_tpl_vars['v']['pics']; ?>
" class="fancybox" data-title="<p><span>作品：</span><?php echo $this->_tpl_vars['v']['title']; ?>
</p><p><span>作者：</span> <?php echo $this->_tpl_vars['v']['name']; ?>
</p><p><span>尺寸：</span> <?php echo $this->_tpl_vars['v']['size']; ?>
</p><p><span>写生地点：</span> <?php echo $this->_tpl_vars['v']['place']; ?>
</p>">
								<div class="pic"><img src="<?php echo $this->_tpl_vars['v']['thumbpic']; ?>
" alt=""></div>
								<div class="txt">
									<p><span>作品：</span><?php echo $this->_tpl_vars['v']['title']; ?>
</p>
									<p><span>作者：</span> <?php echo $this->_tpl_vars['v']['name']; ?>
</p>
									<p><span>尺寸：</span> <?php echo $this->_tpl_vars['v']['size']; ?>
</p>
									<p><span>写生地点：</span> <?php echo $this->_tpl_vars['v']['place']; ?>
</p>
								</div>
							</a>
						</div>
						<?php endforeach; endif; unset($_from); ?>
						<div class="swiper-slide">
							<a href="/index.php?m=wap&c=index&v=scenery">
								<div class="g-more2">
									<span>查看更多游画<i></i></span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="index-row5">
				<h3 class="g-tit1">旅拍TV</h3>
				<div class="m-imgtxt3 swiper-container">
					<div class="swiper-wrapper">
						<?php $_from = $this->_tpl_vars['tv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<div class="swiper-slide">
							<a href="#m-pop1-yz" class="js-video" data-src="<?php echo $this->_tpl_vars['v']['url']; ?>
" data-id="<?php echo $this->_tpl_vars['v']['id']; ?>
">
								<div class="pic">
									<img src="<?php echo $this->_tpl_vars['v']['pics']; ?>
" alt="">
									<div class="txt">
										<h4><?php echo $this->_tpl_vars['v']['title']; ?>
</h4>
										<i></i>
									</div>
								</div>
							</a>
						</div>
						<?php endforeach; endif; unset($_from); ?>
						<div class="swiper-slide">
							<a href="/index.php?m=wap&c=index&v=tv">
								<div class="g-more2">
									<span>查看更多旅拍TV<i></i></span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="index-row6">
				<h3 class="g-tit1">日阅潭</h3>
				<div class="m-date">
					<div class="con">
						<div class="datebox">
							<!-- 月份页码 -->
							<div class="page">
								<div class="date-tit">
									<span id="idCalendarYear"><?php echo $this->_tpl_vars['t']['y']; ?>
</span> 年
									<span id="idCalendarMonth"><?php echo $this->_tpl_vars['t']['m']; ?>
</span> 月
								</div>
							</div>
							<!-- 月份页码 end -->
							<div class="Calendar">
								<!-- 日历 -->
								<table cellspacing="0">
									<thead>
										<tr>
											<td>日</td>
											<td>一</td>
											<td>二</td>
											<td>三</td>
											<td>四</td>
											<td>五</td>
											<td>六</td>
										</tr>
									</thead>
									<tbody id="idCalendar">
										<tr>
											<?php $_from = $this->_tpl_vars['t']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
											<td isclick="0" data-time="<?php echo $this->_tpl_vars['v'][1]; ?>
" id="<?php echo $this->_tpl_vars['v'][0]; ?>
" <?php if ($this->_tpl_vars['v'][0] == $this->_tpl_vars['t']['d']): ?>class="onToday" <?php endif; ?>><?php echo $this->_tpl_vars['v'][0]; ?>
</td>
											<?php endforeach; endif; unset($_from); ?>
										</tr>
									</tbody>
								</table>
								<!-- 日历 end -->
							</div>
						</div>
						<div class="wp">
							<div class="txt" id="getryt">

							</div>
						</div>
						<a href="/index.php?m=wap&c=index&v=ryt" class="g-more1">查看更多</a>
					</div>
				</div>
			</div>
			<div class="m-pop1-yz" id="m-pop1-yz">
				<div class="con">
					<iframe src='' frameborder=0 'allowfullscreen'></iframe>
					<div class="close js-close"><span></span></div>
				</div>
			</div>
			<a href="http://p.qiao.baidu.com/cps/chat?siteId=11959315&userId=25533377" class="g-consultation"><i></i>免费咨询</a>
		</div>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'wap/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<link rel="stylesheet" type="text/css" href="/resource/m/css/swiper.css" />
		<script type="text/javascript" src="/resource/m/js/swiper.js"></script>
		<script>
			var swiper = new Swiper('.banner', {
				slidesPerView: 1,
				loop: true,
				pagination: {
					el: '.swiper-pagination',
					clickable: true
				},
				autoplay: {
					delay: 3000,
					stopOnLastSlide: false,
					disableOnInteraction: true,
				}
			});
			var swiper = new Swiper('.m-imgtxt1', {
				slidesPerView: 1,
				loop: true,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				autoplay: {
					delay: 3000,
					stopOnLastSlide: false,
					disableOnInteraction: true,
				}
			});
			
			var swiper = new Swiper('.m-imgtxt2', {
				slidesPerView: 1.5
			});
			var swiper = new Swiper('.m-imgtxt3', {
				slidesPerView: 1.5
			});
		</script>
		<!-- 弹窗 -->
		<script src="/resource/js/layui/lay/dest/layui.all.js"></script>
		<link rel="stylesheet" type="text/css" href="/resource/m/css/jquery.fancybox.css" media="screen" />
		<script type="text/javascript" src="/resource/m/js/jquery.fancybox.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".fancybox-effects-a").fancybox({
					showCloseButton: false,
					helpers: {
						title: {
							type: 'outside'
						},
						overlay: {
							speedOut: 0
						}
					}
				});
				$(".fancybox").fancybox({
					wrapCSS: 'fancybox-custom',
					closeClick: false,
					openEffect: 'none',
					helpers: {
						title: {
							type: 'inside'
						}
					},
					beforeLoad: function() {
						this.title = $(this.element).data('title');
					}
				});
				$('.js-video').click(function(event) {
					var _id = $(this).attr("href");
					var tid = $(this).attr("data-id");
					var _src = $(this).attr("data-src");
					$.post("/index.php?m=api&c=index&v=showtv", {
						'id': tid
					}, function(data) {

					}, "JSON");
					$(_id).find("iframe").attr("src", _src);
					$(_id).fadeIn();
				});
				$('.js-close').click(function(event) {
					$(this).parents('.m-pop1-yz').fadeOut();
					$(this).parents('#m-pop1-yz').find("iframe").attr("src", "");
					event.stopPropagation();
				});
				$('.zan').click(function(event) {
					var id = $(this).attr('data-id');
					var num = parseInt($(this).attr('data-num'));
					var obj = $(this);
					$.post("/index.php?m=api&c=index&v=zan", {
						'id': id
					}, function(data) {
						if(data.status == 1) {
							$('#zan' + id).html((num + 1));
						} else {
							layer.msg(data.tips);
						}
					}, "JSON");

				});
				bind_td();
//				var host=window.location.host;
//				var src = "//" + host + '/' + 'index.php?m=api&c=index&v=getyzz';
				//var src = "http://test.youxingji.cn/index.php?m=api&c=index&v=getyzz";
//				var data = {
//					type: "mobile"
//				}

//				$.ajax({
//					url: src,
//					data: data,
//					type: "GET",
//					success: function(data) {
//						var sdata = JSON.parse(data);
//						var html='';
//						for(i in sdata) {
//							html +="<div class='swiper-slide' data-id="+sdata[i].id+"><a href="+sdata[i].linkurl+"><div class='pic'><img src="+sdata[i].url+" alt=''><div class='txt'></div></div></a></div>"
//						}
//						$("#swim").append(html);
//						var swiper = new Swiper('.m-imgtxt1', {
//							slidesPerView: 1,
//							loop: true,
//							navigation: {
//								nextEl: '.swiper-button-next',
//								prevEl: '.swiper-button-prev',
//							},
//							autoplay: {
//								delay: 3000,
//								stopOnLastSlide: false,
//								disableOnInteraction: true,
//							}
//						});
//					}
//				});
			});
		</script>
		<!-- 弹窗 end-->
		<!-- 日历 -->
		<script>
			$(document).ready(function() {
				//获取当前日期
				var mydate = new Date();
				var _y = mydate.getFullYear();
				var _m = mydate.getMonth() + 1;
				var _d = mydate.getDate();
				$("#currentDate").text(_y + "年" + _m + "月" + _d + "日");
				getryt(_y + '-' + _m + '-' + _d, _y);
				
			});

			function bind_td() {
				$("#idCalendar td").on('click', function(e) {
					if($(this).attr('isclick') == 1) {
						return false;
					}
					var china_week = ["日", "一", "二", "三", "四", "五", "六"];
					day = $(this).text();
					var time = $(this).data("time");
					var Year = time.substring(0, 4);
					var Month = time.substring(5, 7);

					if(day.length == 1) day = '0' + day;
					das = Year + "-" + Month + "-" + day; // 带-日期
					$("#currentDate").text(Year + "年" + Month + "月" + day + "日");
					getryt(das, Year);
					w = china_week[$(this).index()];
					day > 0 && loadinfo(day, w);
					$(this).parents('.Calendar').find('td').removeClass('onToday');
					day > 0 && $(this).addClass('onToday');
				});
			}

			function loadinfo(d, w) {
				$('.today').html("<span>" + d + "</span>周" + w);
			}

			function getryt(time, t) {
				$.ajax({
					type: "GET",
					url: "/index.php?m=api&c=index&v=getryt",
					data: {
						time: time
					},
					dataType: "json",
					success: function(data) {
						if(data['id']) {
							$('#getryt').html('<div onclick=href("' + '/index.php?m=wap&c=index&v=rytdetai&id=' + data['id'] + '")><img src=' + data['img_url'] + '><div class="title">' + data['title'] + '</div>' + data['homecontent'] + '</div>');
						} else {
							//                  	<h5 onclick=href("'+'/index.php?m=wap&c=index&v=rytdetai&id='+data['id']+'")>'+data['title']+'</h5>
							$('#getryt').html("无内容");
						}
					}
				});
			}
		</script>
		<!--<script type="text/javascript" src="/resource/js/date.js"></script>-->
	</body>

</html>