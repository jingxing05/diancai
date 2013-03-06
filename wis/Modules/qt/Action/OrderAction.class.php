<?php

class OrderAction extends Action {

    /**
     * 初始化函数
     * 如果没有桌号则跳转至原来页面
     */
    function _initialize() {
        //dump($this->_session('unique_tableid'));
        if (!$this->_session('unique_tableid')) {
            //$this->error(U('qt/Index/takeseat'));
            redirect(U('qt/Index/takeseat'));
        }
        import('ORG.Util.Page'); // 导入分页类
    }

    /**
     * 订单首页 默认是前台某个台子的已点菜列表的详情
     */
    function index() {
        //2种情况
        //1、没有下单
        //2、已经下单了
        $Cart = D('Cart');
        $this->assign('dishlist', $Cart->getDishes($this->_session('unique_tableid'))); //
        $this->display(); // 输出模板
    }

    /**
     * 购物车页，没有下单之前 都属于购物车中
     */
    public function cart() {

        $this->display(); // 输出模板
    }

    /**
     * 向 购物车 添加一个菜品
     */
    function addcartdish() {
        $Cart = D('Cart');
        if ($Cart->addCartdish()) {
            $redirecturl = ($this->_post('mubiaourl') ? $this->_post('mubiaourl') : U('qt/Index/index'));
            redirect($redirecturl);
        } else {
            $this->ajaxReturn($Cart->getError());
        }
    }

    /**
     * 向 购物车 添加一个菜品
     */
    function deletecartdish() {
        $Cart = D('Cart');
        $Cart->delete($this->_get('pkid', 'intval'));
        redirect(U('qt/Order/index'));
    }

    /**
     * 向 确认订单
     */
    function confirm() {

        $this->display();
    }

    /**
     * 生成订单
     */
    function neworder() {

        $this->display();
    }

    /**
     * 加菜
     */
    function addorderdish() {

        $this->display();
    }

    /**
     * 退菜
     */
    function deleteorderdish() {

        $this->display();
    }

    /**
     * 结账
     */
    function cashorder() {

        $this->display();
    }

}