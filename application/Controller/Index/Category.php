<?php
/**
 * vpcvcms
 * 分类页面
 */
class Controller_Index_Category extends Core_Controller_TAction
{
	private $catid;
	public function preDispatch() 
	{
        parent::preDispatch();
        $this->catid = $this->getParam('id');
        if(!$this->catid)
        	$this->showmsg('', 'index', 0);
	}
    public function indexAction()
    {
    	$this->assign('cat', C::M('category')->find($this->catid));
		$this->display('category/' . $this->getTempletsByCatId($this->catid));
    }

    private function getTempletsByCatId($catid = 0)
    {
    	if(empty($catid)) return;
    	$templets = array(
    		'16' => 'card.tpl',
    		'17' => 'face.tpl',
    		'18' => 'fly.tpl',
    		'19' => 'passport.tpl',
    		'20' => 'marry.tpl',
    		'21' => 'family.tpl'
    	);

    	return $templets[$catid];
    }
}