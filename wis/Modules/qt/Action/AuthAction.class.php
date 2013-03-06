<?php

class AuthAction extends Action {

    /**
     * 初始化函数
     *
     */
    function _initialize() {
        if ($this->_session('unique_tableid') && ACTION_NAME != 'logout') {
            //$this->error(U('qt/Index/takeseat'));
            $this->redirect($this->_request('qt/Index/index'));
        }
    }

    public function checktable($unique_tblid = 0) {
        if ($this->_post('unique_tableid')) {
            //查看该桌是否已经离桌
            //记录桌号
            session('unique_tableid', $this->_post('unique_tableid'));
        }
        redirect(U('qt/Index/index'));
    }

    public function logout() {
        session('unique_tableid', null);
        redirect(U('qt/Index/index'));
    }

}