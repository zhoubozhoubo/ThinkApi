<?php

namespace app\admin\controller;

use app\util\BaseController;
use think\Db;
use think\Exception;
use think\exception\DbException;

/**
 * NewsController
 * Class News
 * @package app\admin\controller
 */
class News extends BaseController
{

    public $table = 'ContentNews';

    /**
     * 获取列表
     * @return array|string
     * @throws DbException
     * @throws Exception
     */
    public function getList()
    {
        $searchConf = json_decode($this->request->get('searchConf', ''),true);
        $db = Db::name($this->table);
        $where = [];
        if($searchConf){
            foreach ($searchConf as $key=>$val){
                if($val !== ''){
                    if(in_array($key, ["gmt_modified"])){
                        $db->whereTime($key,'between', ["{$val} 00:00:00", "{$val} 23:59:59"]);
                    }else if(in_array($key, ["gmt_create"])){
                        $db->whereTime($key,'between', ["{$val[0]} 00:00:00", "{$val[1]} 23:59:59"]);
                    }else if($key === 'status'){
                        $where[$key] = $val;
                    }else {
                        $where[$key] = ['like', '%'.$val.'%'];
                    }
                }
            }
        }
        $db = $db->where($where)->order('news_id desc');
        return $this->_list($db);
    }


    /**
     * 新增/更新数据
     * @return array
     */
    public function coruData()
    {
        $postData = $this->request->post();
        return $this->coruBase($postData);
    }
}