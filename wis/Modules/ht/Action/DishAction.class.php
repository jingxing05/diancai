<?php

class DishAction extends CommonAction {

    // 就餐情况首页
    public function index() {

        $this->display();
    }

    public function dishes() {
        $M_Dish = D('qt/Dish');
        $data = $M_Dish->field('ctime,pic', true)->select();
        $data = $M_Dish->parseFieldsMap($data);

        dump($data);
        $this->ajaxReturn($data, 'JSON');
    }

    public function mdish() {
        $M_Dish = D('qt/Dish');
        $data = $M_Dish->uporsave($this->_get('pkid'));
        if ($data) {
            $data = true;
        }else{
           $data['m'] = $M_Dish->getError();
        }
        $this->ajaxReturn($data, 'JSON');
    }

}