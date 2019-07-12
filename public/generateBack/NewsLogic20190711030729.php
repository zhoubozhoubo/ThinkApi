<?php

namespace app\admin\logic;

use app\admin\model\ContentNews;
use app\util\BaseLogic;
use app\util\ReturnCode;

/**
 * NewsLogic
 * Class NewsLogic
 * @package app\admin\logic
 */
class NewsLogic extends BaseLogic
{
    /**
     * 参数检测
     * @param $param
     * @return array
     */
    public function check($param)
    {
        //查重
        $whereBase = [
            'is_delete' => ['=', 0]
        ];
        $wherePk = [
            'news_id' => ['<>', $param['news_id']]
        ];
        $whereOr = ['title'=>$param['title'],'synopsis'=>$param['synopsis']];
        if (!$param['news_id']) {
            $count = ContentNews::where(function ($query) use ($whereOr, $whereBase) {
                $query->whereOr($whereOr);
            })->where($whereBase)->count();
        } else {
            $count = ContentNews::where(function ($query) use ($whereOr, $whereBase, $wherePk) {
                $query->whereOr($whereOr);
            })->where($whereBase)->where($wherePk)->count();
        }
        if ($count > 0) {
            return $this->resultFailed(ReturnCode::DATA_REPEAT, '数据重复');
        }
        return $this->resultSuccess();
    }
    
    /**
     * 创建OR更新
     * @param $param
     * @return array
     */
    public function coru($param){
        //实力化操作模型
        $model = new ContentNews();
        //判断创建OR更新
        if (!$param['news_id']) {
            return $res = $this->createBase($model,$param);
        } else {
            return $res = $this->updateBase($model,$param);
        }
    }
}
