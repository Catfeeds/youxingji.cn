<?php
/**
 * vpcvcms
 * 网站首页
 */
class Controller_Wap_Index extends Core_Controller_WapAction
{
    public function preDispatch() 
    {
        parent::preDispatch();
    }
    public function indexAction()
    {
        $starlist = C::M('travel')->where("status = 1 and istop = 1")->order('id desc')->limit('0,1')->select();
        foreach ($starlist as $key => $value) {
            C::M('travel')->where('id', $value['id'])->setInc('shownum', 1);
            $starlist[$key]['describes'] = Core_fun::cn_substr(strip_tags($value['describes']),320,'...');
            $starlist[$key]['content'] = json_decode($value['content']);
            $starlist[$key]['addtime'] = date('Y-m-d', $value['addtime']);
        }
        $scenery = C::M('scenery')->where("istop = 1")->limit("0,3")->order("id desc")->select();
        foreach ($scenery as $key => $value) { 
            $user = C::M('writer')->where("id = $value[wid]")->find();
            $scenery[$key]['name'] = $user['name'];
        }
      	$t = array(
        	'y' => date('Y'),
          	'm' => date('m'),
          	'd' => date('d'),
          	'list' => array(
            	0 => array(date('d', strtotime('-1 sunday', time())),date('Y-m', strtotime('-1 sunday', time()))),
              	1 => array(date("d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),date("Y-m",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")))),
              	2 => array(date("d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+2,date("Y"))),date("Y-m",mktime(0, 0 , 0,date("m"),date("d")-date("w")+2,date("Y")))),
              	3 => array(date("d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+3,date("Y"))),date("Y-m",mktime(0, 0 , 0,date("m"),date("d")-date("w")+3,date("Y")))),
              	4 => array(date("d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+4,date("Y"))),date("Y-m",mktime(0, 0 , 0,date("m"),date("d")-date("w")+4,date("Y")))),
              	5 => array(date("d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+5,date("Y"))),date("Y-m",mktime(0, 0 , 0,date("m"),date("d")-date("w")+5,date("Y")))),
              	6 => array(date("d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+6,date("Y"))),date("Y-m",mktime(0, 0 , 0,date("m"),date("d")-date("w")+6,date("Y")))),
            )
        );
//        var_dump($t);die();
        $tv = C::M('tv')->where("istop = 1 and status = 1")->limit("0,4")->order("id desc")->select();
        $this->assign('starlist', $starlist);
        $this->assign('scenery', $scenery);
        $this->assign('tv', $tv);
      	$this->assign('t', $t);
        $this->display('wap/index.tpl');
    }

    public function noneAction()
    {
        $this->display('wap/none.tpl');
    }
  
    //搜索
    public function searchAction()
    {
        $keyword = trim(htmlspecialchars($this->getParam('keyword'),ENT_QUOTES));
        if(!$keyword){
            $this->showmsg('', '', 0);
        }
        //总数
        $num = 0;
        //查询日阅潭
        $where = "title like '%$keyword%' or content like '%$keyword%'";
        $num = C::M('ryt')->where($where)->getCount() + $num;
        $ryt = C::M('ryt')->field('id,title,content,shownum,addtime,pics')->where($where)->order('id desc')->limit(0,4)->select();
        foreach ($ryt as $key => $value) {
            $ryt[$key]['pics'] = $value['pics']?$value['pics']:'/resource/images/default.jpg';
            $ryt[$key]['title'] = str_replace($keyword, '<font color="red">'.$keyword.'</font>', $value['title']);
            $ryt[$key]['content'] = str_replace($keyword, '<font color="red">'.$keyword.'</font>', Core_fun::cn_substr(strip_tags($value['content']),180,'...'));
            $ryt[$key]['addtime'] = date('Y-m-d', $value['addtime']);
        }
        //甄选之旅
        $num = C::M('article')->where("catid = 17 and useable = 1 and title like '%$keyword%'")->getCount() + $num;
        $journey = C::M('article')->where("catid = 17 and useable = 1 and title like '%$keyword%'")->limit(0,6)->select();
        foreach ($journey as $key => $value) {
            $extends = C::M('module')->mtable($value['moduleid'])->queryOne('*', array(array('aid', $value['id'])));
            $journey[$key]['extend'] = $extends;
        }
        //达人邦
        $num = C::M('travel')->where("status = 1 and describes like '%$keyword%'")->getCount() + $num;
        $star = C::M('travel')->where("status = 1 and describes like '%$keyword%'")->order('id desc')->limit(0,5)->select();
        foreach ($star as $key => $value) {
            $star[$key]['addtime'] = date('Y年m月d日', $value['addtime']);
        }
        //旅拍TV
        $num = C::M('tv')->where("status = 1 and describes like '%$keyword%'")->getCount() + $num;
        $tv = C::M('tv')->where("status = 1 and describes like '%$keyword%'")->order('id desc')->limit(0,5)->select();
        foreach ($tv as $key => $value) {
            $tv[$key]['addtime'] = date('Y年m月d日', $value['addtime']);
        }
        //名家
        $num = C::M('writer')->where("name like '%$keyword%'")->getCount() + $num;
        $writer = C::M('writer')->where("name like '%$keyword%'")->limit("0,4")->order("id desc")->select();
        foreach ($writer as $key => $value) {
            $writer[$key]['introduction'] = str_replace($keyword, '<font color="red">'.$keyword.'</font>', Core_fun::cn_substr(strip_tags($value['introduction']),580,'...'));
        }
        //用户
        $num = C::M('user_member')->where("username like '%$keyword%'")->getCount() + $num;
        $userlist = C::M('user_member')->where("username like '%$keyword%'")->limit("0,8")->order("uid desc")->select();
        foreach ($userlist as $key => $value) {
            $lv = C::M('lv')->where("exp <= ".$value['exp'])->order('id desc')->limit(0,1)->select();
            $userlist[$key]['lvname'] = $lv[0]['lvname'];
            $userlist[$key]['avatar'] = $value['headpic']?$value['headpic']:'/resource/images/img-lb2.png';
        }
        $this->assign('ns', 'search');
        $this->assign('keyword', $keyword);
        $this->assign('num', $num);
        $this->assign ('ryt', $ryt);
        $this->assign ('journey', $journey);
        $this->assign ('star', $star);
        $this->assign ('tv', $tv);
        $this->assign ('writer', $writer);
        $this->assign ('userlist', $userlist);
        $this->display('wap/search.tpl');
    }
  
    //搜索更多
    public function searchmoreAction()
    {
        $type = trim(htmlspecialchars($this->getParam('type'),ENT_QUOTES));
        $keyword = trim(htmlspecialchars($this->getParam('keyword'),ENT_QUOTES));
        if(!$keyword || !$type){
            $this->showmsg('', '', 0);
        }
        $perpage = 20; 
        if($type == 'ryt'){
            $where = "title like '%$keyword%' or content like '%$keyword%'";
            $num = C::M('ryt')->where($where)->getCount();
            $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
            $mpurl = "index.php?m=wap&c=index&v=searchmore&type=ryt&keyword=$keyword";
            $multipage = $this->multipages ($num, $perpage, $curpage, $mpurl);
            $list = C::M('ryt')->where($where)->order('id desc')->limit($perpage * ($curpage - 1), $perpage)->select();
            foreach ($list as $key => $value) {
                $list[$key]['pics'] = $value['pics']?$value['pics']:'/resource/images/default.jpg';
                $list[$key]['title'] = str_replace($keyword, '<font color="red">'.$keyword.'</font>', $value['title']);
                $list[$key]['content'] = str_replace($keyword, '<font color="red">'.$keyword.'</font>', Core_fun::cn_substr(strip_tags($value['content']),180,'...'));
                $list[$key]['addtime'] = date('Y-m-d', $value['addtime']);
            }
        }
        if($type == 'star'){
            $where = "status = 1 and describes like '%$keyword%'";
            $num = C::M('travel')->where($where)->getCount();
            $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
            $mpurl = "index.php?m=wap&c=index&v=searchmore&type=star&keyword=$keyword";
            $multipage = $this->multipages ($num, $perpage, $curpage, $mpurl);
            $list = C::M('travel')->where($where)->order('id desc')->limit($perpage * ($curpage - 1), $perpage)->select();
            foreach ($list as $key => $value) {
                $list[$key]['addtime'] = date('Y年m月d日', $value['addtime']);
            }
        }
        if($type == 'tv'){
            $where = "status = 1 and describes like '%$keyword%'";
            $num = C::M('tv')->where($where)->getCount();
            $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
            $mpurl = "index.php?m=wap&c=index&v=searchmore&type=tv&keyword=$keyword";
            $multipage = $this->multipages ($num, $perpage, $curpage, $mpurl);
            $list = C::M('tv')->where($where)->order('id desc')->limit($perpage * ($curpage - 1), $perpage)->select();
            foreach ($list as $key => $value) {
                $list[$key]['addtime'] = date('Y年m月d日', $value['addtime']);
            }
        }
        if($type == 'writer'){
            $where = "name like '%$keyword%'";
            $num = C::M('writer')->where($where)->getCount();
            $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
            $mpurl = "index.php?m=wap&c=index&v=searchmore&type=writer&keyword=$keyword";
            $multipage = $this->multipages ($num, $perpage, $curpage, $mpurl);
            $list = C::M('writer')->where($where)->order('id desc')->limit($perpage * ($curpage - 1), $perpage)->select();
            foreach ($list as $key => $value) {
                $list[$key]['introduction'] = str_replace($keyword, '<font color="red">'.$keyword.'</font>', Core_fun::cn_substr(strip_tags($value['introduction']),580,'...'));
            }
        }
        if($type == 'user'){
            $where = "username like '%$keyword%'";
            $num = C::M('user_member')->where($where)->getCount();
            $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
            $mpurl = "index.php?m=wap&c=index&v=searchmore&type=user&keyword=$keyword";
            $multipage = $this->multipages ($num, $perpage, $curpage, $mpurl);
            $list = C::M('user_member')->where($where)->order('uid desc')->limit($perpage * ($curpage - 1), $perpage)->select();
            foreach ($list as $key => $value) {
                $lv = C::M('lv')->where("exp <= ".$value['exp'])->order('id desc')->limit(0,1)->select();
                $list[$key]['lvname'] = $lv[0]['lvname'];
                $list[$key]['avatar'] = $value['headpic']?$value['headpic']:'/resource/images/img-lb2.png';
            }
        }
        $this->assign('multipage', $multipage);
        $this->assign('keyword', $keyword);
        $this->assign ('list', $list);
        $this->assign ('type', $type);
        $this->assign('num', $num);
        $this->display('wap/searchmore.tpl');
    }

    //明信片栏目
    public function mxpAction()
    {
        $this->assign('ns', 'mxp');
        $this->display('wap/mxp.tpl');
    }

    //甄选之旅栏目
    public function journeyAction()
    {
        $res = C::M('article')->where('catid = 17 and isspecial = 1 and useable = 1')->find();
        if($res){
            $this->showmsg('', 'index.php?m=wap&c=index&v=journeydetail&id=' . $res['id'], 0);
        }
    }
    //甄选之旅详情
    public function journeydetailAction()
    {
        $id = intval($this->getParam('id'));
        $journey = C::M('article')->where('catid = 17 and useable = 1 and id = ' . $id)->find();
        if(!$id || !$journey){
            $this->showmsg('', '', 0);
            exit;
        }
        $extends = C::M('module')->mtable($journey['moduleid'])->queryOne('*', array(array('aid', $journey['id'])));
        $journey['extend'] = $extends;
        $journey['seotitle'] = $journey['seotitle'] ? $journey['seotitle'] : $journey['title'];
        $galleries = C::M('gallery')->where('itemid = '.$id)->select();
        $features = C::M('journey_features')->where('aid = '.$id)->select();
        $trip = C::M('journey_trip')->where('aid = '.$id)->order('sort asc')->select();
        foreach ($trip as $key => $value) {
            $trip[$key]['pics'] = C::M('gallery')->where('tid = '.$value['id'])->select();
            $n = explode('||', $value['graphic']);
            foreach ($trip[$key]['pics'] as $k => $val) {
                $trip[$key]['pics'][$k]['title'] = $n[$k];
            }
        }
        $this->assign('galleries', $galleries);
        $this->assign('features', $features);
        $this->assign('trip', $trip);
        $this->assign('ns', 'journey');
        $this->assign('count', count($trip));
        $this->assign('journey', $journey);
        $this->assign('year', date("Y",time()));
        $this->assign('month', date("m",time()));
        $this->display('wap/journey.tpl');
    }

    //达人帮栏目
    public function starAction()
    { 
        $perpage = 10; 
        $keyword = htmlspecialchars($this->getParam('keyword'),ENT_QUOTES);
        $where = "status = 1";
        if($keyword){
            $where .= " and describes like '%$keyword%'";
        }
        $Num = C::M('travel')->where($where)->getCount();
        $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
        $mpurl = "index.php?m=wap&c=index&v=star&keyword=$keyword";
        $multipage = $this->multipages ($Num, $perpage, $curpage, $mpurl);
        $list = C::M('travel')->where($where)->order('id desc')->limit($perpage * ($curpage - 1), $perpage)->select();
        foreach ($list as $key => $value) {
            C::M('travel')->where('id', $value['id'])->setInc('shownum', 1);
            $list[$key]['content'] = json_decode($value['content']);
            $list[$key]['picnum'] = count(json_decode($value['content']));
            $list[$key]['addtime'] = date('Y-m-d H:i:s', $value['addtime']);
        }
        //推荐达人
        $tjstar = C::M('user_member')->where("weektop = 1")->order("rand()")->limit('0,1')->select();
        if($tjstar){
            $tjstar[0]['avatar'] = $tjstar[0]['headpic']?$tjstar[0]['headpic']:'/resource/images/img-lb2.png';
        }
        //目的在
        $tourismlist = C::M('tourism')->select();
        
        $this->assign('tjstar', $tjstar);
        $this->assign('list', $list);
        $this->assign('num', $Num);
        $this->assign('ns', 'star'); 
        $this->assign ('keyword', $keyword);
        $this->assign ('multipage', $multipage);
        $this->assign ('tourismlist', $tourismlist);
        $this->display('wap/star.tpl');
    }

    //tv栏目
    public function tvAction()
    {
        $perpage = 12;
        //查询所有标签
        $sql = "Select DISTINCT(tags) from ##__tv where status = 1 and tags <> ''";
        $tagslist = Core_Db::fetchAll($sql, false);
        foreach ($tagslist as $key => $value) {
            $tagslist[$key + 1] = $value;
        }
        unset($tagslist[0]);
        $where = "status = 1";
        $keyword = htmlspecialchars($this->getParam('keyword'),ENT_QUOTES);
        $type = intval($this->getParam ('type'));
        if($type){
            $tags = $tagslist[$type]['tags'];
            if($tags){
                $where .= " and tags = '$tags'";
            }
        }
        if($keyword){
            $where .= " and describes like '%$keyword%' or title like '%$keyword%'";
        }
        $Num = C::M('tv')->where($where)->getCount();
        $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
        $mpurl = "index.php?m=wap&c=index&v=tv&type=$type&keyword=$keyword";
        $multipage = $this->multipages ($Num, $perpage, $curpage, $mpurl);
        $list = C::M('tv')->where($where)->order('id desc')->limit($perpage * ($curpage - 1), $perpage)->select();
        foreach ($list as $key => $value) {
            //C::M('tv')->where('id', $value['id'])->setInc('shownum', 1);
            $user = C::M('user_member')->where("uid = " . $value['uid'])->find();
            $list[$key]['addtime'] = date('Y/m/d', $value['addtime']);
            $list[$key]['avatar'] = $user['headpic']?$user['headpic']:'/resource/images/img-lb2.png';
        }
        $tjuser = C::M('user_member')->where("tvtop = 1")->order("rand()")->limit('0,6')->select();
        foreach ($tjuser as $key => $value) {
            $tjuser[$key]['avatar'] = $value['headpic']?$value['headpic']:'/resource/images/img-lb2.png';
        }
        $this->assign('tjuser', $tjuser);
        $this->assign('list', $list);
        $this->assign('type', $type);
        $this->assign('ns', 'tv');
        $this->assign('keyword', $keyword);
        $this->assign('tagslist', $tagslist);
        $this->assign ('multipage', $multipage);
        $this->display('wap/tv.tpl');
    }

    //招募
    public function recruitingAction()
    {
        $id = intval($this->getParam('id'));
        $recruiting = C::M('recruiting')->where('id = ' . $id)->find();
        if(!$id || !$recruiting){
            $this->showmsg('', '', 0);
            exit;
        }
        $this->assign('ns', 'recruiting');
        $this->assign('res', $recruiting);
        $this->display('mb/'.$recruiting['wap_mb']);
    }

    //报名
    public function enteredAction()
    {
        $id = intval($this->getParam('id'));
        $recruiting = C::M('recruiting')->where('id = ' . $id)->find();
        if(!$id || !$recruiting){
            $this->showmsg('', '', 0);
            exit;
        }
        $this->assign('ns', 'entered');
        $this->assign('res', $recruiting);
        $this->display('wap/entered.tpl');
    }

    //日月潭栏目
    public function rytAction()
    {
        $y = intval($this->getParam('y')) ? intval($this->getParam('y')) : date('Y');
        $dy = date('Y');
        $dm = date('n');
        if($y > $dy){
            $y = $dy;
        }elseif($y < 2010){
            $y = 2010;
        }
        $list = array();
        if($dy == $y){
            $list = $this->rl($y, $dy, $dm);
        }else{
            $list = $this->rl($y);
        }
        $this->assign('y', $y);
        $this->assign('ns', 'ryt');
        $this->assign('list', $list);
        $this->assign('year', date('Y'));
        $this->assign('month', date('n'));
        $this->display('wap/ryt.tpl');
    }

    //日月潭算法
    public function rl($y, $dy = '', $dm = '12')
    {
        $list = array();
        for ($i=12; $i >= 1; $i--) { 
            if($dm >= $i){
                $first[$i] = strtotime(date("$y-$i-01 00:00:00"));
                //计算每月前面的空格
                $first[$i] = date("w", $first[$i]);
                for ($j=0; $j < $first[$i]; $j++) {
                    $list[$i]['table'][] = $j;
                }
                //计算每月多少天
                $maxDay = date('t', strtotime("" . date("$y") . "-" . date("$i") . ""));
                for ($s = $maxDay; $s >= 1; $s--) {
                    $start_time = strtotime(date("$y-$i-$s")." 00:00:00");
                    $end_time=strtotime(date("$y-$i-$s")." 23:59:59");
                    $res = C::M('ryt')->where("addtime between $start_time and $end_time")->find();
                    if($res){
                        $list[$i]['time'][] = array(
                            'status' => 1,
                            'id' => $res['id'],
                            'pics' => $res['pics'],
                            'time' => $y . '-' . $i . '-' . $s,
                            'days' => $s,
                            'keyword' => $res['keyword']?$res['keyword']:'查看详情'
                        );
                    }else{
                        $list[$i]['time'][] = array(
                            'status' => 0,
                            'time' => $y . '-' . $i . '-' . $s,
                            'days' => $s
                        );
                    }
                }
                //最后的
                $total = $first[$i]+ count($list[$i]['time']);
                $other = array();
                for ($x = 0; $x < ceil($maxDay / 7) * 7 - $total ; $x++) {
                    $list[$i]['other'][] = $x;
                }
            }else{
                $list[$i] = $i;
            }
        }
        return $list;
    }

    //日月潭详情
    public function rytdetaiAction()
    {
        $id = intval($this->getParam('id'));
        $article = C::M('ryt')->where('id', $id)->find();
        if(!$article){
            $this->showmsg('', '/', 0);
            exit;
        }
        $article['addtime'] = date('Y-m-d', $article['addtime']);
        C::M('ryt')->where('id', $id)->setInc('shownum', 1);

        //推荐日月潭
        $tjryt = C::M('ryt')->where("istop = 1")->order("rand()")->limit('0,5')->select();
        //日月潭
        $tjlist = C::M('ryt')->where("istop = 1")->order("shownum desc")->limit('0,10')->select();

        //评论
        $perpage = 5;
        $Num = C::M('comment')->where("status = 1 and rid = $id")->getCount();
        $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
        $mpurl = "index.php?m=wap&c=index&v=rytdetai&id=$id";
        $multipage = $this->multipages ($Num, $perpage, $curpage, $mpurl);
        $comment = C::M('comment')->where("status = 1 and rid = $id")->order('id asc')->limit($perpage * ($curpage - 1), $perpage)->select();
        foreach ($comment as $key => $value) {
            $comment[$key]['lou'] = $curpage * $perpage + $key - 4;
            $comment[$key]['content'] = Core_Fun::ubbreplace($value['content']);
            $comment[$key]['addtime'] = date('Y-m-d H:i', $value['addtime']);
        }

        $this->assign('ns', 'ryt');
        $this->assign('tjryt', $tjryt);  
        $this->assign('tjlist', $tjlist);  
        $this->assign('article', $article);  
        $this->assign('comment', $comment);  
        $this->assign('multipage', $multipage);  
        $this->display('wap/rytdetai.tpl');
    }

    //游画栏目
    public function sceneryAction()
    {
        $writer = C::M('writer')->where("istop = 1")->limit("0,4")->order("sort desc,id DESC")->select();
        foreach ($writer as $key => $value) {
            $writer[$key]['list'] = C::M('scenery')->where("wid = $value[id]")->limit("0,4")->order("id desc")->select();
        }
        $scenery = C::M('scenery')->where("ishottop = 1")->limit("0,6")->order("id desc")->select();
        foreach ($scenery as $key => $value) {
            $user = C::M('writer')->where("id = $value[wid]")->find();
            $scenery[$key]['name'] = $user['name'];
        }
        $this->assign('ns', 'scenery');
        $this->assign('writer', $writer);
        $this->assign('scenery', $scenery);
        $this->display('wap/scenery.tpl');
    }

    //油画作家
    public function writerAction()
    {
        $id = intval($this->getParam('id'));
        $writer = C::M('writer')->where("id = $id")->find();
        if(!$writer){
            $this->showmsg('', '', 0);
        }
        $scenery = C::M('scenery')->where("wid = $id")->order("id desc")->select();
        $this->assign('writer', $writer);
        $this->assign('scenery', $scenery);
        $this->assign('ns', 'scenery');
        $this->display('wap/writer.tpl');
    }

    //油画作家列表
    public function writerlistAction()
    {
        $_orderby = "sort desc,id DESC";
        $where = "isshow = 1";
        $Num = C::M('writer')->where($where)->getCount();
        $perpage = 10;
        $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
        $mpurl = "index.php?m=wap&c=index&v=writerlist";
        $multipage = $this->multipages($Num, $perpage, $curpage, $mpurl);
        $list =  C::M('writer')->where($where)->order($_orderby)->limit($perpage * ($curpage - 1), $perpage)->select();
        foreach ($list as $key => $value) {
            $list[$key]['introduction'] = Core_Fun::cn_substr($value['introduction'], 400, '...');
            if($value['sex'] == 1){
                $list[$key]['sex'] = '男';
            }else{
                $list[$key]['sex'] = '女';
            }
        }
        $scenery = C::M('scenery')->where("ishottop = 1")->limit("0,6")->order("id desc")->select();
        foreach ($scenery as $key => $value) {
            $user = C::M('writer')->where("id = $value[wid]")->find();
            $scenery[$key]['name'] = $user['name'];
        }
        $this->assign('list', $list);
        $this->assign ('multipage', $multipage);
        $this->assign('scenery', $scenery);
        $this->assign('ns', 'scenery');
        $this->display('wap/writerlist.tpl');
    }
  
    //热门作品列表
    public function hotsceneryAction()
    {
        $_orderby = "id DESC";
        $where = "ishottop = 1";
        $Num = C::M('scenery')->where($where)->getCount();
        $perpage = 12;
        $curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
        $mpurl = "index.php?m=wap&c=index&v=hotscenery";
        $multipage = $this->multipages($Num, $perpage, $curpage, $mpurl);
        $list =  C::M('scenery')->where($where)->order($_orderby)->limit($perpage * ($curpage - 1), $perpage)->select();
        foreach ($list as $key => $value) {
            $user = C::M('writer')->where("id = $value[wid]")->find();
            $list[$key]['name'] = $user['name'];
        }
        $this->assign('list', $list);
        $this->assign ('multipage', $multipage);
        $this->assign('ns', 'scenery');
        $this->display('wap/hotscenery.tpl');
    }

    //登录
    public function loginAction()
    {
        if($_SESSION['userinfo']){
            $this->showmsg('', 'index.php?m=wap&c=user&v=index', 0);
            exit;
        }
        $this->assign('ns', 'login');
        $this->display('wap/login.tpl');
    }

    //注册
    public function regAction()
    {
        if($_SESSION['userinfo']){
            $this->showmsg('', 'index.php?m=wap&c=user&v=index', 0);
            exit;
        }
        $this->assign('ns', 'reg');
        $this->display('wap/reg.tpl');
    }
  
    //找回密码
    public function forgetAction()
    {
        if($_SESSION['userinfo']){
            $this->showmsg('', 'index.php?m=wap&c=user&v=index', 0);
            exit;
        }
        $this->assign('ns', 'forget');
        $this->display('wap/forget.tpl');
    }
    
    //微博登录
    public function weibologinAction()
    {
        define( "WB_AKEY" , '2155157593' );
        define( "WB_SKEY" , '9e1b2d860d853951b0345fd72683b02d' );
        define( "WB_CALLBACK_URL" , 'http://wwww.youxingji.cn/index.php?m=index&c=index&v=weibocallback' );
        include_once( ROOT . "vendor/weibo"."/saetv2.ex.class.php");
        $o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
        $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
        header("location: $code_url");
    }

    //微博回调处理
    public function weibocallbackAction()
    {
        define( "WB_AKEY" , '2155157593' );
        define( "WB_SKEY" , '9e1b2d860d853951b0345fd72683b02d' );
        define( "WB_CALLBACK_URL" , 'http://m.youxingji.cn/index.php?m=index&c=index&v=weibocallback' );
        include_once( ROOT . "vendor/weibo"."/saetv2.ex.class.php");
        $o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = WB_CALLBACK_URL;
            try {
                $token = $o->getAccessToken( 'code', $keys ) ;
            } catch (OAuthException $e) {
              
            }
        } 
        if($token){
            $c = new saetclientv2(WB_AKEY,WB_SKEY,$token['access_token']);  
            $ms = $c->home_timeline();  
            $uid_get = $c->get_uid();  
            $uid = $uid_get['uid'];
            $token['userinfo'] = $c->show_user_by_id($uid); //微博sdk方法获取用户的信息  
            $userinfo = C::M('user_member')->where("wb_openid = '$token[uid]'")->find();
            if($userinfo){
                $_SESSION['userinfo'] = $userinfo;
                $this->showmsg('登录成功，跳转中...', '/index.php?m=wap&c=user&v=index', 2);
            }else{
                $userdata = array(
                    'username' => $token['userinfo']['name'],
                    'realname' => $token['userinfo']['name'],
                    'wb_openid' => $token['uid'],
                    'password' => md5($token['uid']),
                    'regip' => Core_Comm_Util::getClientIp(),
                    'regtime' => Core_Fun::time()
                );
                if(C::M('user_member')->add($userdata)){
                    $_SESSION['userinfo'] = C::M('user_member')->where("wb_openid = '$token[uid]'")->find();
                    $this->showmsg('登录成功，跳转中...', '/index.php?m=wap&c=user&v=index', 2);
                }else{
                    $this->showmsg('登陆失败，跳转中...', '/index.php?m=wap&c=index&v=wblogin', 2);
                }
            }
        }
    }

    //QQ登录
    public function qqloginAction()
    {
        $appid = '101459157';
        $appsecret = '95f4d1ff7094d37474d36b30b456fb17';
        /*  指定回调地址  */
        $url = 'http://www.youxingji.cn/index.php?m=wap&c=index&v=qqlogin';
        $redirect_uri = urlencode($url);
        if(isset($_GET['from']))
        {
            $_SESSION['callbackurl'] = $_GET['from'];
        }
        if(!isset($_GET['code'])){
            $_SESSION['state'] = md5(uniqid(rand(), TRUE));
            $url= 'https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id='.$appid.'&redirect_uri='.$redirect_uri.'&scope=get_user_info&state='.$_SESSION['state'];
            header('Location:'.$url);
            exit;
        }
       // if (isset($_GET['code']) &&  ($_GET['state'] == $_SESSION['state']) && !isset($userarr['token']))
      if (isset($_GET['code']) && !isset($userarr['token']))
        {
            $userarr['state']=$_SESSION['state'];
            $userarr['code'] = $_GET['code'];
            $url="https://graph.qq.com/oauth2.0/token?client_id=".$appid."&client_secret=".$appsecret."&code=".$_GET['code']."&grant_type=authorization_code&redirect_uri=".$redirect_uri;
            $res = $this->https_request($url);
            $arr = $this->tokenstring_array($res);
            $userarr['token'] = $arr;
        }else{
            $this->showmsg('授权失败，跳转中...', '/index.php?m=wap&c=index&v=qqlogin', 2);
            exit;
        }
        if(isset($userarr['token']['access_token']) && $userarr['token']['refresh_token'])
        {
            $date['access_token'] = $userarr['token']['access_token'];
            $date['refresh_token'] = $userarr['token']['refresh_token'];
            $url='https://graph.qq.com/oauth2.0/me?access_token='.$userarr['token']['access_token'];
            $res = $this->https_request($url);
            if(preg_match('/callback\(([\s\S]*)\);/',$res,$matchs)){
                $arr= json_decode($matchs[1],true);
            }
            $userarr['openid']=$arr['openid'];
        }else{
            $this->showmsg('授权失败，跳转中...', '/index.php?m=wap&c=index&v=qqlogin', 2);
            exit;
        }
        if (isset($userarr['openid']))
        {
            $date['openid']=$userarr['openid'];//用户@openid
            $url = 'https://graph.qq.com/user/get_user_info?access_token='.$userarr['token']['access_token'].'&oauth_consumer_key='.$appid.'&openid='.$userarr['openid'];
            $res = $this->https_request($url);
            $res = json_decode($res, true);//最终得到的用户信息
            $userarr['userinfo'] = $res;
            $date['nickname']=$userarr['userinfo']['nickname'];//用户@昵称
            if(isset($userarr['userinfo']['figureurl_qq_2']) or isset($userarr['userinfo']['figureurl_qq_1']))
            {
                $date['figureurl']=$userarr['userinfo']['figureurl_qq_2']?$userarr['userinfo']['figureurl_qq_2']:$userarr['userinfo']['figureurl_qq_1'];//用户头像
            }
            $date['userinfo']=$userarr['userinfo'];
        }else{
            $this->showmsg('授权失败，跳转中...', '/index.php?m=wap&c=index&v=qqlogin', 2);
            exit;
        }
        unset($_SESSION['state']);
        if($date['openid']){
            $userinfo = C::M('user_member')->where("qq_openid = '$date[openid]'")->find();
            if($userinfo){
                $_SESSION['userinfo'] = $userinfo;
                $this->showmsg('登录成功，跳转中...', '/index.php?m=wap&c=user&v=index', 2);
            }else{
                $userdata = array(
                    'username' => $date['nickname'],
                    'realname' => $date['nickname'],
                    'qq_openid' => $date['openid'],
                    'password' => md5($date['openid']),
                    'regip' => Core_Comm_Util::getClientIp(),
                    'regtime' => Core_Fun::time()
                );
                if(C::M('user_member')->add($userdata)){
                    $_SESSION['userinfo'] = C::M('user_member')->where("qq_openid = '$date[openid]'")->find();
                    $this->showmsg('登录成功，跳转中...', '/index.php?m=wap&c=user&v=index', 2);
                }else{
                    $this->showmsg('登陆失败，跳转中...', '/index.php?m=wap&c=index&v=qqlogin', 2);
                }
            }
            
        }
    }

    public function weixinloginAction(){
        //-------配置
        $AppID = 'wx38a6b42245eae69d';
        $AppSecret = 'd7fef39a6ce15d4fb923059bb05f5722';
        $callback = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?m=wap&c=index&v=weixincallback'; //回调地址
        //微信登录
        session_start();
        //-------生成唯一随机串防CSRF攻击
        $state  = md5(uniqid(rand(), TRUE));
        $_SESSION["wx_state"]    =   $state;//存到SESSION
        $callback = urlencode($callback);
        $wxurl = "https://open.weixin.qq.com/connect/qrconnect?appid=".$AppID."&redirect_uri=".$callback."&response_type=code&scope=snsapi_login&state=".$state."#wechat_redirect";
        header("Location: $wxurl");
    }
  
    public function weixincallbackAction(){
        if($_GET['state']!=$_SESSION["wx_state"]){
              exit("5001");
        }
        $AppID = 'wx38a6b42245eae69d';
        $AppSecret = 'd7fef39a6ce15d4fb923059bb05f5722';
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$AppID.'&secret='.$AppSecret.'&code='.$_GET['code'].'&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $json =  curl_exec($ch);
        curl_close($ch);
        $arr=json_decode($json,1);
        $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $json =  curl_exec($ch);
        curl_close($ch);
        $arr=json_decode($json,1);
        //逻辑处理
        unset($_SESSION['wx_state']);
        if($arr['openid']){
            $userinfo = C::M('user_member')->where("wx_openid = '$arr[openid]'")->find();
            if($userinfo){
                $_SESSION['userinfo'] = $userinfo;
                $this->showmsg('登录成功，跳转中...', '/index.php?m=wap&c=user&v=index', 2);
            }else{
                $userdata = array(
                    'username' => $arr['nickname'],
                    'realname' => $arr['nickname'],
                    'wx_openid' => $arr['openid'],
                    'password' => md5($arr['openid']),
                    'regip' => Core_Comm_Util::getClientIp(),
                    'regtime' => Core_Fun::time()
                );
                if(C::M('user_member')->add($userdata)){
                    $_SESSION['userinfo'] = C::M('user_member')->where("wx_openid = '$arr[openid]'")->find();
                    $this->showmsg('登录成功，跳转中...', '/index.php?m=wap&c=user&v=index', 2);
                }else{
                    $this->showmsg('登陆失败，跳转中...', '/index.php?m=wap&c=index&v=qqlogin', 2);
                }
            }
            
        }
    }

    public function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
  
    public function tokenstring_array($res)
    {
        if(strpos($res, 'expires_in'))
        {
            if(preg_match('/access_token=(\w+)\&/',$res,$matchs1))
            {
                $arr['access_token']=$matchs1[1];
            }
            if(preg_match('/expires_in=(\w+)\&/',$res,$matchs2))
            {
                $arr['expires_in']=$matchs2[1];
            }
            if(preg_match('/refresh_token=(\w+)/',$res,$matchs3))
            {
                $arr['refresh_token']=$matchs3[1];
            }
            return $arr;
        }
    }
}