<?php

class AuthAction extends Action {

    /**
     * 初始化函数
     *
     */
    function _initialize() {
        if ($this->_session('unique_tableid')) {
            //$this->error(U('qt/Index/takeseat'));
            $this->redirect($this->_request('qt/Index/index'));
        }
    }

    public function checktable($unique_tblid = 0){
        dump($_POST);
        if($this->_post('unique_tableid')){
            //查看该桌是否已经离桌
            //记录桌号
            session('unique_tableid',$this->_post('unique_tableid'));
        }
        redirect(U('qt/Index/index'));

    }

}