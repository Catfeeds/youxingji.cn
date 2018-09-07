<?php
/**
 * Created by PhpStorm.
 * User: Kael
 * Date: 2018/6/13
 * Time: 14:14
 */
class Model_StarTravel extends Core_Model
{
    protected $_tableName = 'star_travel as a';
    protected $_idkey = 'id';

    public function __construct()
    {
        parent::__construct();
    }


    public function get_list($field=array(),$curpage=1,$limit=15){
        $orderBy="a.id DESC";
        $join_str=" left join g_user_member as b on a.user_id=b.uid";
        $limit_arr=array($limit,$limit*($curpage-1));
        return $this->joinAll([],$orderBy,$limit_arr,$field,$join_str);
    }

    public function get_one($id){
        $select_field=array("a.*");
        $join_str="";
        $where[]=array("a.id",$id);
        return $this->joinOne($select_field,$where,[],$join_str);
    }

    public function add($data)
    {
        $rt = Core_Db::insert ("g_star_travel" , $data , array());
        if (true === $rt && $data[$this->_idkey]) {
            $rt = $data[$this->_idkey];
        }

        return $rt;
    }

    public function get_living_sketch($type=1)
    {
        $orderBy="a.id DESC";
        $field=array("a.*","b.username","b.autograph","b.headpic");
        $join_str=" left join g_user_member as b on a.user_id=b.uid";
        $where[]=array("a.status",1);
        if( $type==1 ){
            $limit_arr=array(2,0);
        }else{
            $limit_arr=array(1,0);
        }

        return $this->joinAll($where,$orderBy,$limit_arr,$field,$join_str);
    }

    public function get_detail($id)
    {
        $field=array("a.*","b.with_one","b.feture","b.cost_explain","visa_explain","b.tips");
        $join_str=" left join g_star_travel_detail as b on b.star_travel_id=a.id";
        $where[]=array("a.id",$id);
        return $this->joinOne($field,$where,[],$join_str);
    }



}