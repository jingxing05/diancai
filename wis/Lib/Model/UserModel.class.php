<?php

class UserModel extends Model {
    /**
     * #########################################
     * #前台功能区
     * #########################################
     */

    /**
     * 分页查询
     * @param type $count 每页条数
     * @return type
     */
    public function getList($count = 4) {
        return $this->order('id DESC')->field(true)->limit($count)->select();
    }

    public function getDetail($id = 0) {
        return $this->field(true)->find($id);
    }

    /**
     * #########################################
     * #后台功能区
     * #########################################
     */




    /**
     * #########################################
     * #配置区
     * #########################################
     */
    protected $tableName = 'user';
    //数据库字段
    protected $fields = array(
        'uid', 'mtime', 'ctime', 'role', 'uname', 'nick', 'email', 'pwd',
        '_pk' => 'uid', '_autoinc' => true
    );
    //字段映射
    protected $_map = array(
        'pkid' => 'uid',
        'xgsj' => 'mtime', //修改时间
        'cjsj' => 'ctime', //加入时间
        'juese' => 'role', //图片
        'zhanghao' => 'uname', //帐号 登录的
        'nicheng' => 'nick', //帐号 昵称
        'dianyou' => 'email', //帐号 电邮 可用来登录
        'mima' => 'pwd', //帐号 密码 md5加密
    );
    //自动完成
    protected $_auto = array(
        array('mtime', 'time', Model::MODEL_BOTH, 'function'), // add或更新时记录时间戳
        array('ctime', 'time', Model::MODEL_INSERT, 'function'), //add时 记录时间戳
        array('pwd','md5',self::MODEL_BOTH,'function'), //自动加密
    );
    //数据自动验证
    protected $_validate = array(
        array('uname', '1,40', '帐号1-40个字符!', Model::EXISTS_VALIDATE, 'length'), // 长度
        array('uname', '', '帐号已存在!', Model::EXISTS_VALIDATE, 'unique'), // 长度
        array('nick', '1,40', '昵称1-40个字符!', Model::EXISTS_VALIDATE, 'length'), // 长度
        array('pwd', '6,16', '密码长度1-16位!', Model::EXISTS_VALIDATE, 'length'),
        array('repassword', 'pwd', '确认密码不一致', self::EXISTS_VALIDATE, 'confirm'),
        array('role', '0,1,2,3', '没有该相应的角色!', Model::EXISTS_VALIDATE, 'in'), // 长度
        array('email', '', '邮箱已存在!', Model::EXISTS_VALIDATE, 'unique'), // 长度
        array('email', '', '邮箱格式错误!', Model::EXISTS_VALIDATE, 'email'), // 长度
    );
    //命名范围 可以一次定义多次调用，并且在项目中也能起到分工配合的规范，避免开发人员在写CURD操作的时候出现问题
    //项目经理只需要合理的规划命名范围即可
    protected $_scope = array(
    );

    //表单合法性检测
    //字段比较多，可使用field方法的排除功能，例如：$User->field('status,create_time',true)->create();
}