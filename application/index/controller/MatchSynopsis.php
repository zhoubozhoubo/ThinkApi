<?php

namespace app\index\controller;

use think\Controller;

class MatchSynopsis extends Controller{
    public function index(){
        return $this->fetch();
    }
}