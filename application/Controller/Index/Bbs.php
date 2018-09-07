<?php
/**
 * vpcvcms
 * 论坛
 */
class Controller_Index_Bbs extends Core_Controller_TAction
{
	private $_cUser;
	public function preDispatch() 
	{
		parent::preDispatch();
		$this->_cUser = $this->getUser();
	}
    public function indexAction()
    {
		$this->assign('forums', 	C::M('Forum')->getForumTree(0, true));
		//$this->assign('newthreads', C::M('Forumthread')->getThreadList('', 5, 'addtime DESC', 'isbest'));
		//$this->assign('hotthreads', C::M('Forumthread')->getThreadList('', 5, 'addtime DESC', 'ishot'));
		//$this->assign('notices', 	C::M('Forumthread')->getThreadList(2, 5));
		$this->assign('postsnum', 	C::M('Forumpost')->getCount());
		$this->assign('nownum', C::M('Forumthread')->getThreadsByTime());
		$this->assign('prevnum', C::M('Forumthread')->getThreadsByTime(-1));
		$this->assign('usernum', C::M('User_Member')->getUserCount());
        $this->display('bbs/index.tpl');
    }
	
	public function threadsAction()
	{
		$forumid = $this->getParam('forumid');
		$orderby = $this->getParam('orderby');
		$forum = C::M('Forum')->find($forumid);
		if(!C::M('Forum')->checkForumPrivOne('allowview', $forumid, $this->_cUser['uid']))
		{
			$this->showmsg('此版块不允许浏览', 'bbs');
		}
		//查询条件
		$_search = array(
			array('forumid', '', $forumid),
			array('useable', '', 1)
		);
		$_searchArr = $this->setWhereCondition($_search);
		if($orderby == 'best')
			$order = "isbest DESC";
		elseif($orderby == 'views')
			$order = "views DESC, replies DESC";
		elseif($orderby == 'lastpost')
			$order = "lastpost DESC";
		$_orderby = $order ? $order : "addtime DESC";
		
		$Num = C::M('Forumthread')->getCount($_searchArr['where']);
		$perpage = 20;
		$curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
		$_c = Core_Comm_Util::map2str ($_searchArr['conditions'], '/', '/');
		$_c = empty ($_c) ? '' : '/' . $_c;
		$mpurl = '/bbs/threads' . $_c . '/';
		$multipage = $this->multipage ($Num, $perpage, $curpage, $mpurl);
		$threads = C::M('Forumthread')->queryAll($_searchArr['where'], $_orderby, array($perpage, $perpage * ($curpage - 1)));
		foreach($threads AS $idx => $thread)
		{
			$threads[$idx]['headpic'] = C::M('User_Member')->getInfoByUid('headpic30', $thread['uid']);
			$threads[$idx]['icon'] = C::M('Forumthread')->formatIcon($thread);
		}
		$this->assign('threads', 		$threads);
		$this->assign('orderby', 		$orderby);
		$this->assign ('multipage', 	$multipage);
		//$this->assign('notices', 		C::M('Forumthread')->getThreadList(5, 1));
		$this->assign('bests', 			C::M('Forumthread')->getThreadList('', 10, 'istop DESC', 'istop'));
		$this->assign('content', 		Core_Fun::getEditor('content', '', 100, 797, 'bbs'));
		$this->assign('forum', 			$forum);
		$this->assign('refer', 			Core_Fun::iurlencode(Core_Fun::getPathroot() . 'bbs/threads-' . $forumid . '#fast'));
		$this->display('bbs/threads.tpl');
	}
	
	public function postAction()
	{
		$action = $this->getParam('action');
		$forumid = $this->getParam('forumid');
		$special = $this->getParam('special');
		$back = $special ? Core_Fun::getPathroot() . 'bbs/post/forumid/' . $forumid . '/special/' . $special : Core_Fun::getPathroot() . 'bbs/post/forumid/' . $forumid;
		if(!$this->_cUser['uid'])
			$this->showmsg('', 'u/login?refer=' . Core_Fun::iurlencode($back), 0);
		if($action && $action == 'post')
		{
			if($special)
			{
				$votes = $this->getParam('newvotename');
				if(count($votes) < 2 || $votes[0] == '' || $votes[1] == '')
				{
					$this->showmsg('投票项目至少有两个');
				}
			}
			
			$title = $this->getParam('title');
			$content = $this->getParam('content');
			$replycredit = $this->getParam('replycredit');
			$isrush = $this->getParam('isrush');
			if($title == '')
				$this->showmsg('请输入标题');
			if($content == '')
				$this->showmsg('请输入内容');
			$this->setCookie('post-thread', serialize(array('title' => $title, 'content' => $content)));
			//验证附加码
			//if (!Core_Lib_Gdcheck::check($this->getParam('gdkey')))
				//$this->showmsg('验证码不正确');
			$time = Core_Fun::time();
			$data = array(
				'forumid' => $forumid,
				'username' => $this->_cUser['username'],
				'uid' => $this->_cUser['uid'],
				'title' => $title,
				'titlecolor' => $this->getParam('titlecolor'),
				'addtime' => $time,
				'lastpost' => $time,
				'lastpostuid' => $this->_cUser['uid'],
				'lastposter' => $this->_cUser['username'],
				'special' => $special,
				'views' => 1,
				'useable' => 1,
				'replies' => 0,
				'replycredit' => $replycredit,
				'isrush' => $isrush
			);
			$attach = Core_Comm_Util::getAttch($content);
			if($_FILES['attach']['tmp_name'] != '')
			{
				$file = Core_Util_Upload::upload('attach', '/attach', 'jpg,png,gif', false, false, false);
				$data['attach'] = $file['link'];
			}
			else
			{
				$data['attach'] = $attach;
			}
			$threadid = C::M('Forumthread')->add($data);
			if($threadid > 0)
			{
				$forum['id'] = $forumid;
				$forum['threads'] = 1;
				$forum['posts'] = 1;
				$forum['lastpost'] = $time;
				C::M('Forum')->editForum($forum);
				
				$postData = array(
					'forumid' => $forumid,
					'threadid' => $threadid,
					'isfirst' => 1,
					'username' => $this->_cUser['username'],
					'uid' => $this->_cUser['uid'],
					'title' => $title,
					'content' => $content,
					'special' => $special,
					'useable' => 1,
					'addtime' => $time,
					'postip' => Core_Comm_Util::getClientIp(),
					'replycredit' => $replycredit
				);
				C::M('Forumpost')->add($postData);
				if($votes)
				{
					C::M('Forumvote')->addVote($threadid, $votes);
				}
				if($replycredit != '')
				{
					$random = $this->getParam('random');
					$random = ($random < 0 || $random > 99) ? 0 : $random;
					$creditdata = array(
						'threadid' => $threadid,
						'credit' => $replycredit,
						'times' => $this->getParam('times'),
						'usertimes' => $this->getParam('usertimes'),
						'random' => $random
					);
					C::M('Forumcredit')->addCredit($creditdata);
				}
				
				$starttime = $this->getParam('starttime');
				$endtime = $this->getParam('endtime');
				if($starttime != '' && $endtime != '')
				{
					$rushdata = array(
						'isrush' => $isrush,
						'threadid' => $threadid,
						'starttime' => Core_Fun::strtotime($starttime),
						'endtime' => Core_Fun::strtotime($endtime),
						'stopfloor' => $this->getParam('stopfloor'),
						'usertimes' => $this->getParam('usertimes'),
						'rewardfloor' => $this->getParam('rewardfloor')
					);
					C::M('Forumrush')->addRush($rushdata);
				}
				
				/*$sum = C::M('Credit')->getSumByUidAndDay($this->_cUser['uid'], 'thread_post');
				if($sum < 50)
				{
					C::M('User_Member')->updateUserScore($this->_cUser['uid'], Core_Comm_Util::getUserCredit('thread_post'));
					C::M('Credit')->addCredit($this->_cUser['uid'], $threadid, 'thread_post');
				}*/
				$this->showmsg('发表帖子成功', 'bbs/threads/forumid/' . $forumid);
			}
			else
			{
				$this->showmsg('发表帖子失败', 'bbs/threads/forumid/' . $forumid);
			}
		}
		else
		{
			$post = unserialize($this->getCookie('post-thread'));
			if($forumid)
			{
				if(!C::M('Forum')->checkForumPrivOne('allowpost', $forumid, $this->_cUser['uid']))
				{
					$this->showmsg('此版块不允许发帖', 'bbs');
				}
			}
			
			$forums = C::M('Forum')->getForumList();
			foreach($forums AS $idx => $forum)
			{
				$forums[$idx]['son'] = C::M('Forum')->getForumList($forum['id']);
			}
			$this->assign('forums', $forums);
			$this->assign('forumname', C::M('Forum')->getOne('name', array(array('id', $forumid))));
			$this->assign('forumid', $forumid);
			$this->assign('_postName', 'post');
			$this->assign('_text', '发表帖子');
			$this->assign('post', $post);
			$this->assign('special', $special);
			$this->assign('content', Core_Fun::getEditor('content', '', 400, 760, 'bbs'));
			$this->display('bbs/newthread.tpl');
		}
	}
	
	public function displayAction()
	{
		$forumid = $this->getParam('forumid');
		$threadid = $this->getParam('threadid');
		$isrush = $this->getParam('isrush');

		if(!C::M('Forumthread')->getCount(array(array('id', $threadid), array('useable', 1))))
		{
			$this->showmsg('主题不存在或者未审核', 'bbs/threads/forumid/' . $forumid);
		}
		
		C::M('Forumthread')->updateForumViews($threadid);
		$thread = C::M('Forumthread')->find($threadid);
		$thread['icon'] = C::M('Forumthread')->formatIcon($thread, false);
		//查询条件
		$_search = array(
			array('forumid', ''),
			array('threadid', '')
		);
		$isrush && $_search[] = array('isrush', '', 1);
		$_searchArr = $this->setWhereCondition($_search);
		
		$_orderby = "isfirst DESC, addtime ASC";
		
		$Num = C::M('Forumpost')->getCount($_searchArr['where']);
		$perpage = 10;
		$curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
		$_c = Core_Comm_Util::map2str ($_searchArr['conditions'], '/', '/');
		$_c = empty ($_c) ? '' : '/' . $_c;
		$mpurl = '/bbs/display' . $_c . '/';
		$multipage = $this->multipage ($Num, $perpage, $curpage, $mpurl);
		$posts = C::M('Forumpost')->queryAll($_searchArr['where'], $_orderby, array($perpage, $perpage * ($curpage - 1)));
		foreach($posts AS $idx => $post)
		{
			$user = C::M('User_Member')->getUserInfoByUid($post['uid']);
			$level = C::M('User_Member')->formatUserLevel($post['uid']);
			$posts[$idx]['headpic'] 	= $user['headpic150'];
			$posts[$idx]['threadsnum'] 	= C::M('Forumthread')->getThreadsByUid($post['uid']);
			$posts[$idx]['postsnum'] 	= C::M('Forumpost')->getPostsByUid($post['uid']);
			$posts[$idx]['level'] 		= $level['star'];
			$posts[$idx]['group'] 		= $level['groupname'];
			$posts[$idx]['regtime'] 	= $user['regtime'];
			$posts[$idx]['lastvisit'] 	= $user['lastvisit'];
		}
		if($thread['special'])
		{
			$this->assign('votes', C::M('Forumvote')->getVotes($threadid));
		}
		$this->assign('credit', 	C::M('Forumcredit')->getCreditByThreadId($threadid));
		$this->assign('rush', 		C::M('Forumrush')->getRushByThreadId($threadid));
		$this->assign('posts', 		$posts);
		$this->assign ('multipage', $multipage);
		$this->assign('forumid', 	$forumid);
		$this->assign('threadid', 	$threadid);
		$this->assign('thread', 	$thread);
		$this->assign('forumname', 	C::M('Forum')->getOne('name', array(array('id', $forumid))));
		$this->assign('content', 	Core_Fun::getEditor('content', '', 150, 797, 'bbs'));
		$this->assign('refer', 		Core_Fun::iurlencode(Core_Fun::getPathroot() . 'bbs/display/forumid/' . $forumid . '/threadid/' . $threadid . '#reply'));
		$this->assign('isrush', 	$isrush);
		$this->assign('isstow', 	C::M('stow')->checkStow($this->_cUser['uid'], $threadid, 'thread'));
		$this->display('bbs/display.tpl');
	}
	
	public function replyAction()
	{
		$forumid = $this->getParam('forumid');
		if(!C::M('Forum')->checkForumPrivOne('allowreply', $forumid, $this->_cUser['uid']))
		{
			$this->showmsg('此版块不允许回复', 'bbs');
		}
		$threadid = $this->getParam('threadid');
		$action = $this->getParam('action');
		$time = Core_Fun::time();
		$thread = C::M('Forumthread')->find($threadid);
		$rush = C::M('Forumrush')->getRushByThreadId($threadid);
		
		if($action && $action == 'post')
		{
			if($thread['isrush'] == 1)
			{
				$postnum = C::M('Forumpost')->getPostsByUidAndThreadId($this->_cUser['uid']);
				if($postnum >= $rush['usertimes'])
				{
					$this->showmsg('对不起，你已经达到本主题的回帖上限。');
				}
			}
			$postallnum = C::M('Forumpost')->getCount();
			$content = $this->getParam('content');
			if($content == '')
				$this->showmsg('请输入内容');
			$postData = array(
				'forumid' => $forumid,
				'threadid' => $threadid,
				'isfirst' => 0,
				'username' => $this->_cUser['username'],
				'uid' => $this->_cUser['uid'],
				'title' => '',
				'content' => $this->getParam('content'),
				'useable' => 1,
				'addtime' => $time,
				'postip' => Core_Comm_Util::getClientIp()
			);
			$postid = C::M('Forumpost')->add($postData);
			if($postid > 0)
			{
				$forum['id'] = $forumid;
				$forum['posts'] = 1;
				$forum['lastpost'] = $time;
				C::M('Forum')->editForum($forum);
				$threaddata['id'] = $threadid;
				$threaddata['replies'] = 1;
				$threaddata['lastpost'] = $time;
				$threaddata['lastpostuid'] = $this->_cUser['uid'];
				$threaddata['lastposter'] = $this->_cUser['username'];
				C::M('Forumthread')->editForumThread($threaddata);

				/*$sum = C::M('Credit')->getSumByUidAndDay($this->_cUser['uid'], 'thread_reply');
				if($sum < 50)
				{
					C::M('User_Member')->updateUserScore($this->_cUser['uid'], Core_Comm_Util::getUserCredit('thread_reply'));
					C::M('Credit')->addCredit($this->_cUser['uid'], $threadid, 'thread_reply');
				}*/
				if($thread['replycredit'] > 0)
				{
					$creditrule = C::M('Forumcredit')->getCreditByThreadId($threadid);
					if(!empty($creditrule['times']))
					{
						$havecredit = C::M('Credit')->getCountByUidAndPostId($this->_cUser['uid'], $threadid, 'thread_replycredit');
						if($creditrule['usertimes'] - $havecredit > 0 && $thread['replycredit'] - $creditrule['credit'] >= 0)
						{
							if($creditrule['random'] > 0) {
								$rand = rand(1, 100);
								$rand_replycredit = $rand <= $creditrule['random'] ? true : false ;
							} else {
								$rand_replycredit = true;
							}
							if($rand_replycredit)
							{
								//C::M('User_Member')->updateUserScore($this->_cUser['uid'], $creditrule['credit']);
								//C::M('Credit')->addCredit($this->_cUser['uid'], $threadid, 'thread_replycredit', $creditrule['credit']);
								C::M('Forumpost')->update(array('id' => $postid, 'replycredit' => $creditrule['credit']));
							}
						}
					}
				}
				if($rush['stopfloor'] > 0 && $postallnum <= $rush['stopfloor'] && strpos($rush['rewardfloor'], $postallnum + 1) !== false && $rush['starttime'] <= Core_Fun::time() && $rush['endtime'] >= Core_Fun::time())
				{
					C::M('Forumpost')->update(array('id' => $postid, 'isrush' => 1));
				}
				C::M('User_Message')->addMessage(array(
					'type' => 'system',
					'fromuid' => $this->_cUser['uid'],
					'fromrealname' => $this->_cUser['username'],
					'touid' => $thread['uid'],
					'folder' => 'bbs',
					'title' => '帖子回复',
					'message' => '你的主题【' . $thread['title'] . '】收到回复',
					'sendtime' => Core_Fun::time(),
					'writetime' => Core_Fun::time(),
					'useable' => 1
				));
				$this->showmsg('回复帖子成功', 'bbs/display/forumid/' . $forumid . '/threadid/' . $threadid);
			}
			else
			{
				$this->showmsg('回复帖子失败', 'bbs/display/forumid/' . $forumid . '/threadid/' . $threadid);
			}
		}
	}
	
	public function groupAction()
	{
		$gid = $this->getParam('gid');
		$forums = C::M('Forum')->getForumTree($gid, 0, 0, 0, true);
		$group = C::M('Forum')->find($gid);
		$this->assign('forums', $forums);
		$this->assign('group', $group);
        $this->display('bbs/group.tpl');
	}
	
	public function editAction()
	{
		$action = $this->getParam('action');
		$forumid = $this->getParam('forumid');
		$threadid = $this->getParam('threadid');
		$thread = C::M('Forumthread')->find($threadid, 'titlecolor');
		$postid = C::M('Forumpost')->getOne('id', array(array('isfirst', 1), array('threadid', $threadid)));
		$post = C::M('Forumpost')->find($postid);
		$post['titlecolor'] = $thread['titlecolor'];
		$post['attach'] = $thread['attach'];
		if($action && $action == 'edit')
		{
			if($thread['special'])
			{
				$newvotes = $this->getParam('newvotename');
				$votes = $this->getParam('votename');
				$voteids = $this->getParam('voteids');
				if(count($votes) < 2 || $votes[0] == '' || $votes[1] == '')
				{
					$this->showmsg('投票项目至少有两个');
				}
			}
			$title = $this->getParam('title');
			$content = $this->getParam('content');
			$replycredit = $this->getParam('replycredit');
			$isrush = $this->getParam('isrush');
			if($title == '')
				$this->showmsg('请输入标题');
			if($content == '')
				$this->showmsg('请输入内容');
			//验证附加码
			//if (!Core_Lib_Gdcheck::check($this->getParam('gdkey')))
				//$this->showmsg('验证码不正确');
			$time = Core_Fun::time();
			$data = array(
				'id' => $threadid,
				'titlecolor' => $this->getParam('titlecolor'),
				'title' => $this->getParam('title'),
				'replycredit' => $replycredit,
				'isrush' => $isrush
			);
			if($_FILES['pic']['tmp_name'] != '')
			{
				Core_Fun_File::delete(BASEROOT . $post['attach']);
				$file = Core_Util_Upload::upload('pic', '/bbs', 'jpg,png,gif', false, false, false);
				$data['attach'] = $file['link'];
			}
			else
			{
				$data['attach'] = $attach;
			}
			$update = C::M('Forumthread')->update($data);
			if($update)
			{
				$postData = array(
					'id' => $postid,
					'title' => $this->getParam('title'),
					'content' => $content,
					'postip' => Core_Comm_Util::getClientIp(),
					'replycredit' => $replycredit
				);
				C::M('Forumpost')->update($postData);
				if($newvotes)
				{
					C::M('Forumvote')->addVote($threadid, $newvotes);
				}
				if($votes)
				{
					foreach($votes AS $idx => $vote)
					{
						C::M('Forumvote')->update(array('id' => $voteids[$idx], 'votename' => $vote));
					}
				}
				if($replycredit != '')
				{
					$random = $this->getParam('random');
					$random = ($random < 0 || $random > 99) ? 0 : $random;
					$creditdata = array(
						'threadid' => $threadid,
						'credit' => $replycredit,
						'times' => $this->getParam('times'),
						'usertimes' => $this->getParam('usertimes'),
						'random' => $random
					);
					C::M('Forumcredit')->addCredit($creditdata);
				}
				$starttime = $this->getParam('starttime');
				$endtime = $this->getParam('endtime');
				if($starttime != '' && $endtime != '')
				{
					$rushdata = array(
						'isrush' => $isrush,
						'threadid' => $threadid,
						'starttime' => Core_Fun::strtotime($starttime),
						'endtime' => Core_Fun::strtotime($endtime),
						'stopfloor' => $this->getParam('stopfloor'),
						'usertimes' => $this->getParam('usertimes'),
						'rewardfloor' => $this->getParam('rewardfloor')
					);
					C::M('Forumrush')->addRush($rushdata);
				}
				$this->showmsg('修改帖子成功', 'bbs/display/forumid/' . $forumid . '/threadid/' . $threadid);
			}
			else
			{
				$this->showmsg('修改帖子失败', 'bbs/edit/forumid/' . $forumid . '/threadid/' . $threadid);
			}
		}
		else
		{
			$forums = C::M('Forum')->getForumList();
			foreach($forums AS $idx => $forum)
			{
				$forums[$idx]['son'] = C::M('Forum')->getForumList($forum['id']);
			}
			$this->assign('forums', $forums);
			$votes = C::M('Forumvote')->queryAll(array(array('threadid', $threadid)));
			$credit = C::M('Forumcredit')->queryOne('*', array(array('threadid', $threadid)));
			$this->assign('forumname', C::M('Forum')->getOne('name', array(array('id', $forumid))));
			$this->assign('votes', $votes);
			$this->assign('credit', $credit);
			$this->assign('rush', C::M('Forumrush')->getRushByThreadId($threadid));
			$this->assign('forumid', $forumid);
			$this->assign('threadid', $threadid);
			$this->assign('post', $post);
			$this->assign('_postName', 'edit');
			$this->assign('_text', '修改帖子');
			$this->assign('content', Core_Fun::getEditor('content', $post['content'], 400, 760, 'bbs'));
			$this->display('bbs/newthread.tpl');
		}
	}
	
	public function guideAction()
	{
		$ac = $this->getParam('ac');
		if($ac == 'my')
		{
			if(!$this->_cUser['uid'])
				$this->showmsg('', 'u/login?refer=' . Core_Fun::iurlencode(Core_Fun::getPathroot() . 'bbs/guide-my'), 0);
			$_search = array(
				array('uid', '', $this->_cUser['uid'])
			);
			$_orderby = "addtime DESC, isbest DESC, istop DESC";
			$guidetxt = '我的帖子';
		}
		if($ac == 'best')
		{
			$_search = array(
				array('isbest', '', 1)
			);
			$_orderby = "addtime DESC, istop DESC";
			$guidetxt = '精华帖子';
		}
		if($ac == 'hot')
		{
			$_search = array(
			);
			$_orderby = "ishot DESC, replies DESC, views DESC, istop DESC, addtime DESC";
			$guidetxt = '热门帖子';
		}
		$_searchArr = $this->setWhereCondition($_search);
		$Num = C::M('Forumthread')->getCount($_searchArr['where']);
		$perpage = Core_Config::get ('page_size', 'basic', 10);
		$curpage = $this->getParam ('page') ? intval ($this->getParam ('page')) : 1;
		$_c = Core_Comm_Util::map2str ($_searchArr['conditions'], '/', '/');
		$_c = empty ($_c) ? '' : '/' . $_c;
		$mpurl = '/bbs/guide' . $_c . '/';
		$multipage = $this->multipage ($Num, $perpage, $curpage, $mpurl);
		$threads = C::M('Forumthread')->queryAll($_searchArr['where'], $_orderby, array($perpage, $perpage * ($curpage - 1)));
		foreach($threads AS $idx => $thread)
		{
			$threads[$idx]['headpic'] = C::M('User_Member')->getInfoByUid('headpic', $thread['uid']);
			$threads[$idx]['icon'] = C::M('Forumthread')->formatIcon($thread);
		}
		$this->assign('threads', $threads);
		$this->assign ('multipage', $multipage);
		$this->assign('notices', C::M('Forumthread')->getThreadList(5, 1));
		$this->assign('guidetxt', $guidetxt);
		$this->assign('ac', $ac);
		$this->display('bbs/guides.tpl');
	}
	
	public function delvoteAction()
	{
		$voteid = $this->getParam('id');
		C::M('Forumvote')->remove($voteid);
		C::M('Forumvoter')->removeall("voteid = '$voteid'");
		echo Core_Fun::array2json(array('msg' => 1));
	}
	
	public function voteAction()
	{
		$voteid = $this->getParam('voteid');
		$threadid = $this->getParam('threadid');
		$data = array(
			'id' => $voteid,
			'votes' => 1,
			'voteuids' => 1
		);
		if(C::M('Forumvote')->updateVote($data))
		{
			$userdata = array(
				'threadid' => $threadid,
				'uid' => $this->_cUser['uid'],
				'username' => $this->_cUser['username'],
				'voteid' => $voteid,
				'addtime' => Core_Fun::time()
			);
			C::M('Forumvoter')->add($userdata);
			$arr['msg'] = 1;
		}
		else
		{
			$arr['msg'] = 0;
		}
		echo Core_Fun::array2json($arr);
	}
	
	public function delAction()
	{
		$threadid = $this->getParam('threadid');
		$forumid = $this->getParam('forumid');
		C::M('Forumthread')->remove ($threadid);
		C::M('Forumpost')->removeall("threadid = '$threadid'");
		$this->showmsg('删除成功', 'bbs/threads/forumid/' . $forumid);
	}
}
?>