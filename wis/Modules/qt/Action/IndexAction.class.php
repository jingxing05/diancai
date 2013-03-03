<?php

// +----------------------------------------------------------------------
// | TOPThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://topthink.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

class IndexAction extends Action {

    /**
     * 初始化函数
     * 如果没有桌号则跳转至就坐页面
     */
    function _initialize() {
        dump($this->_session('unique_tableid'));
        if (!$this->_session('unique_tableid')) {
            //$this->error(U('qt/Index/takeseat'));
            redirect(U('qt/Auth/takeseat'));
        }
    }

    public function index() {
        $User = D('Form');
        import('ORG.Util.Page'); // 导入分页类
        $count = $User->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 4); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->display(); // 输出模板

    }

    function read($id = 0) {
        $Model = D('Form');
        $this->assign('vo', $Model->getDetail($id));
        $this->display();
    }

}