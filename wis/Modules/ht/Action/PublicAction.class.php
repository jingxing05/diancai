<?php

class PublicAction extends Action {

    // 检查用户是否登录
    protected function checkUser() {
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->error('没有登录', __GROUP__ . '/Public/login');
        }
    }

    // 顶部页面
    public function top() {
        C('SHOW_RUN_TIME', false);   // 运行时间显示
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }

    public function drag() {
        C('SHOW_PAGE_TRACE', false);
        C('SHOW_RUN_TIME', false);   // 运行时间显示
        $this->display();
    }

    // 尾部页面
    public function footer() {
        C('SHOW_RUN_TIME', false);   // 运行时间显示
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }

    // 菜单页面
    public function menu() {
        $this->checkUser();
        C('SHOW_RUN_TIME', false);   // 运行时间显示
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }

    // 用户登录页面
    public function login() {
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->display();
        } else {
            $this->redirect('Index/index');
        }
    }

    public function index() {
        //如果通过认证跳转到首页
        redirect(__GROUP__);
    }

    // 用户登出
    public function logout() {
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->success('登出成功！', __URL__ . '/login/');
        } else {
            $this->error('已经登出！');
        }
    }

    // 登录检测
    public function pass() {

        $errors = array();
        if (empty($_POST['zhanghao'])) {
            $errors['f'] = 'zhanghao';
            $errors['m'] = '帐号错误！';
        } elseif (empty($_POST['mima'])) {
            $errors['f'] = 'mima';
            $errors['m'] = '密码必须！';
        } elseif (empty($_POST['verifycode'])) {
            $errors['f'] = 'verifycode';
            $errors['m'] = '验证码必须！';
        }
        if ($errors) {
            $this->ajaxReturn($errors, 'JSON');
        }

        //验证码
        if (session('verify') != md5($_POST['verifycode'])) {
            $errors['f'] = 'verifycode';
            $errors['m'] = '验证码错误！';
            $this->ajaxReturn($errors);
        }
        //生成认证条件
        $map = array();
        // 支持使用绑定帐号登录
        $map['uname'] = $this->_post('zhanghao');
        $map["status"] = array('gt', 0);

        $authInfo = M('User')->where($map)->find();
        //使用用户名、密码和状态的方式进行认证
        if (false === $authInfo) {
            $errors['f'] = 'zhanghao';
            $errors['m'] = '帐号不存在或已禁用！';
            $this->ajaxReturn($errors);
        } else {
            if ($authInfo['pwd'] != md5($_POST['mima'])) {
                $errors['f'] = 'mima';
                $errors['m'] = '密码错误！';
                $this->ajaxReturn($errors);
            }
            $_SESSION[C('USER_AUTH_KEY')] = $authInfo['uid'];
            $_SESSION['email'] = $authInfo['email'];
            $_SESSION['loginUserName'] = $authInfo['nick'];
            if ($authInfo['uname'] == 'admin') {
                $_SESSION['administrator'] = true;
            }
            //保存登录信息
            $longinhistory = M('user_loginhistory');
            $data = array();
            $data['uid'] = $authInfo['uid'];
            $data['ltime'] = time();
            $data['lip'] = get_client_ip();
            $longinhistory->add($data);
            $this->ajaxReturn(true);
        }
    }

    // 更换密码
    public function changePwd() {
        $this->checkUser();
        //对表单提交处理进行处理或者增加非表单数据
        if (md5($_POST['verify']) != $_SESSION['verify']) {
            $this->error('验证码错误！');
        }
        $map = array();
        $map['password'] = md5($_POST['oldpassword']);
        if (isset($_POST['account'])) {
            $map['account'] = $_POST['account'];
        } elseif (isset($_SESSION[C('USER_AUTH_KEY')])) {
            $map['id'] = $_SESSION[C('USER_AUTH_KEY')];
        }
        //检查用户
        $User = M("User");
        if (!$User->where($map)->field('id')->find()) {
            $this->error('旧密码不符或者用户名错误！');
        } else {
            $User->password = md5($_POST['password']);
            $User->save();
            $this->success('密码修改成功！');
        }
    }

    public function profile() {
        $this->checkUser();
        $User = M("User");
        $vo = $User->getById($_SESSION[C('USER_AUTH_KEY')]);
        $this->assign('vo', $vo);
        $this->display();
    }

    public function verify() {
        $type = isset($_GET['type']) ? $_GET['type'] : 'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify(4, 1, $type);
    }

    // 修改资料
    public function change() {
        $this->checkUser();
        $User = D("User");
        if (!$User->create()) {
            $this->error($User->getError());
        }
        $result = $User->save();
        if (false !== $result) {
            $this->success('资料修改成功！');
        } else {
            $this->error('资料修改失败!');
        }
    }

}