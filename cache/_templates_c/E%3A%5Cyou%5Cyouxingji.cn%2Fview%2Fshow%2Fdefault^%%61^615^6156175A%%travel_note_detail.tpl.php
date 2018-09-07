<?php /* vpcvcms compiled created on 2018-07-26 14:48:56
         compiled from index/travel_note_detail.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $this->_tpl_vars['article']['title']; ?>
_<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'site_name','group' => 'site','default' => "致茂网络"), $this);?>
</title>
    <meta name="description" content="<?php echo $this->_tpl_vars['article']['title']; ?>
" />
    <meta name="keywords" content="<?php echo $this->_tpl_vars['article']['title']; ?>
" />
    <link rel="stylesheet" href="/resource/css/module.css" />
    <link rel="stylesheet" href="/resource/css/module-less.css" />
    <link rel="stylesheet" href="/resource/css/style.css" />
    <script src="/resource/js/jquery.min.js"></script>
    <script src="/resource/js/lib.js"></script>
    <style>
        .qqFace { margin-top: 4px; background: #fff; padding: 2px; border: 1px #dfe6f6 solid; }
        .qqFace table td { padding: 0px;line-height: 28px;}
        .qqFace table td img { cursor: pointer; border: 1px #fff solid; }
        .qqFace table td img:hover { border: 1px #0066cc solid; }
    </style>

</head>

<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="main">
    <?php $_from = C::T('ad')->getList(array('tagname' => 'rytdetailslide'));if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['adlist']):
?>
    <div class="ban s2" style="background-image: url(<?php echo $this->_tpl_vars['adlist']['imgurl']; ?>
);"></div>
    <?php endforeach; endif; unset($_from); ?>
    <div class="cur">
        <div class="wp">
            <a href="">首页</a> &gt; <a href="/index.php?m=index&c=index&v=ryt">日阅潭</a> &gt; <span><?php echo $this->_tpl_vars['article']['title']; ?>
</span>
        </div>
    </div>
    <div class="wp">
        <div class="m-master-qm">
            <div class="col-l">
                <div class="m-text1-qm">
                    <h1><?php echo $this->_tpl_vars['article']['title']; ?>
</h1>
                    <div class="info">
                        <span>By <em><?php echo $this->_tpl_vars['article']['username']; ?>
</em></span>
                        <span><?php echo $this->_tpl_vars['article']['addtime']; ?>
</span>
                        <div class="g-operation-qm">
                            <a href="javascript:;" class="look"><i></i><?php echo $this->_tpl_vars['article']['show_num']; ?>
</a>|
                            <a href="javascript:;" class="zan" data-id="<?php echo $this->_tpl_vars['article']['id']; ?>
" data-num="<?php echo $this->_tpl_vars['article']['top_num']; ?>
"><i></i><?php echo $this->_tpl_vars['article']['top_num']; ?>
</a>
                        </div>
                    </div>
                    <div class="txt">
                        <?php echo $this->_tpl_vars['article']['content']; ?>

                    </div>
                </div>

                <div class="m-comment-qm">
                    <!--PC版-->
                    <div id="SOHUCS" sid="<?php echo $this->_tpl_vars['source_id']; ?>
"></div>
                    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
                    <script type="text/javascript">
                        window.changyan.api.config({
                            appid: 'cytIKVFKm',
                            conf: 'prod_84acd83354d56f4258f7a43b366bb19d'
                        });
                    </script>
                </div>
            </div>
            <div class="col-r">
                <h3 class="g-tit1-qm">日阅潭推荐</h3>
                <div class="m-pic2-qm">
                    <div class="slider">
                        <?php $_from = $this->_tpl_vars['tjryt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['vo']):
?>
                        <div class="item">
                            <a href="/index.php?m=index&c=index&v=rytdetai&id=<?php echo $this->_tpl_vars['vo']['id']; ?>
">
                                <div class="pic">
                                    <img src="<?php echo $this->_tpl_vars['vo']['pics']; ?>
" alt="">
                                    <span><?php echo $this->_tpl_vars['vo']['title']; ?>
</span>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                </div>
                <h3 class="g-tit1-qm">相关目录</h3>
                <ul class="ul-txt2-qm">
                    <?php $_from = $this->_tpl_vars['tjlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['vo']):
?>
                    <li>
                        <span><?php echo $this->_tpl_vars['k']+1; ?>
/</span>
                        <a href="/index.php?m=index&c=index&v=rytdetai&id=<?php echo $this->_tpl_vars['vo']['id']; ?>
"><?php echo $this->_tpl_vars['vo']['title']; ?>
</a>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="h81"></div>
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
    $('.zan').click(function(event) {
        var id = $(this).attr('data-id');
        var num = parseInt($(this).attr('data-num'));
        var obj = $(this);
        $.post("/index.php?m=api&c=index&v=zanryt", {
            'id':id
        }, function(data){
            if(data.status == 1){
                $(obj).html('<i></i>'+(num+1));
            }else{
                layer.msg(data.tips);
            }
        },"JSON");

    });
</script>

<script type="text/javascript">
    $(function(){
        $('#pageqr').click(function(){
            var page = $('#pages').val();
            if(page){
                window.location.href="/index.php?m=index&c=index&v=rytdetai&id=<?php echo $this->_tpl_vars['article']['id']; ?>
&page=" + page + "#comment";
            }
        })

        $(".btnComment").click(function(){
            var str = $("#saytext").val();
            $.post("/index.php?m=api&c=index&v=comment", {
                'str':str,
                'rid':'<?php echo $this->_tpl_vars['article']['id']; ?>
'
            }, function(data){
                layer.msg(data.tips);
                if(data.status == 1){
                    $("#saytext").val('');
                }
            },"JSON");
        });
    });

    //查看结果

    function replace_em(str){
        str = str.replace(/\</g,'&lt;');
        str = str.replace(/\>/g,'&gt;');
        str = str.replace(/\n/g,'<br/>');
        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/resource/arclist/$1.gif" border="0" />');
        return str;
    }

    //登录控制
    function cyLogin()
    {
        layer.confirm('请您先登录再进行评论!', {
            btn: ['登录','取消'] //按钮
        }, function(){
            window.open("http://www.youxingji.cn/index.php?m=index&c=index&v=login");
            setIntervalDemo();
        }, function(){

        });

    }

    function setIntervalDemo() {
        setTimeoutName = setInterval(function() {
            //查看是否登录
            $.ajax({
                type: "GET",
                url: "http://www.youxingji.cn/index.php?m=api&c=comment&v=get_userinfo&flag=true",
                success: function(res) {
                    var data=JSON.parse(res);
                    if( data.is_login==1 ){
                        window.location.reload();
                    }else{
                    }
                }
            });

        }, 5000);
    }



</script>

</body>

</html>