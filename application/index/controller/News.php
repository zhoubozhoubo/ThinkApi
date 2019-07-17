<?php
/**
 * Created by PhpStorm.
 * User: zb
 * Date: 19-7-15
 * Time: 下午5:28
 */

namespace app\index\controller;

use app\index\model\ContentNews;
use think\Controller;

class News extends Controller{
    public function index(){
//        $where = [
//            'status'=>1,
//            'is_delete'=>0
//        ];
//        $news = ContentNews::where($where)->paginate(10);
//        $page = $news->render();
//
//        $this->assign('news',$news);
//        $this->assign('page',$page);

        return $this->fetch();
    }
}