<?php

namespace app\admin\logic;

use app\admin\model\ContentNews;
use app\util\BaseLogic;
use app\common\utils\ReturnCode;

/**
 * NewsLogic
 * Class NewsLogic
 * @package app\admin\logic
 */
class NewsLogic extends BaseLogic
{
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
