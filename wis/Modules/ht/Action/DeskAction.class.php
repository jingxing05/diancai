<?php
class DeskAction extends CommonAction {
    // 就餐情况首页
    public function index() {
        //
        $data['desklist'] = M('item_desk')->select();  
        $this->assign($data);        
        $this->display();
    }
}