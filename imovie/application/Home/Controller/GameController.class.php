<?php
namespace Home\Controller;
use Think\Controller;
class GameController extends Controller{
    //俄罗斯方块
    function russia(){
        $this->display();
    }
    //贪吃蛇
     function snake(){
        $this->display();
    }
    //斗兽棋
    function beast(){
        $this->display();
    }

}