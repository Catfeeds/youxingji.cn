<?php /* vpcvcms compiled created on 2018-09-05 14:06:56
         compiled from wap/article/index_about.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $this->_tpl_vars['nav']['seotitle']; ?>
_<?php echo $this->_reg_objects['TO'][0]->cfg(array('key' => 'site_name','group' => 'site','default' => "致茂网络"), $this);?>
</title>
    <meta name="keywords" content="<?php echo $this->_tpl_vars['nav']['keywords']; ?>
" />
    <meta name="description" content="<?php echo $this->_tpl_vars['nav']['description']; ?>
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
        <h3>关于我们</h3>
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
        <div class="ban">
            <a href="">
            <img src="/resource/m/images/q-ban1.jpg" alt="" />
        </a>
        </div>
        <div class="m-txt1">
            <div class="wp">
                <ul class="ul-txt1">
                    <?php $_from = C::T('channel')->getList(array('channel' => 'footer'));if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
                    <li <?php if ($this->_tpl_vars['vo']['id'] == $this->_tpl_vars['nav']['id']): ?>class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['vo']['url']; ?>
"><?php echo $this->_tpl_vars['vo']['name']; ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
        </div>
        <div class="m-text1">
            <div class="wp">
                <h4 class="g-tit-yz" style="background-image: url(/resource/m/images/line-yz1.jpg)"><?php echo $this->_tpl_vars['nav']['name']; ?>
</h4>
            </div>
            <div class="txt">
                <?php if ($this->_tpl_vars['nav']['id'] == 12): ?>
                    <script>
                        window.location.href = "/index.php?m=wap&c=index&v=reg";
                    </script>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['nav']['id'] == 15): ?>
                    <script>
                        window.location.href = "/index.php?m=wap&c=index&v=ryt";
                    </script>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['nav']['id'] == 16): ?>
                    <script>
                        window.location.href = "/index.php?m=wap&c=index&v=journey";
                    </script>
                <?php endif; ?>
                <?php echo $this->_tpl_vars['nav']['body']; ?>

            </div>
        </div>
    </div>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'wap/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>

</html>