<?php

class DishModel extends Model {
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
    protected $tableName = 'item_dish';

    //数据库字段
    protected $fields = array(
        'did', 'mtime', 'ctime', 'price', 'mprice', 'pic', 'name', 'descr',
        '_pk' => 'did', '_autoinc' => true
    );
    //字段映射
    protected $_map = array(
        'pkid' => 'did',
        'xgsj' => 'mtime', //修改时间
        'cjsj' => 'ctime', //创建时间
        'jg' => 'price', //价格
        'scjg' => 'mprice', //市场价格
        'tp' => 'pic', //图片
        'cm' => 'name', //菜名
        'ms' => 'descr', //描述
    );
    //自动完成
    protected $_auto = array(
        array('mtime', 'time', Model::MODEL_BOTH, 'function'), // add或更新时记录时间戳
        array('ctime', 'time', Model::MODEL_INSERT, 'function'), //add时 记录时间戳
    );
    //数据自动验证
    protected $_validate = array(
        array('name', array(1, 50), '菜品名称1-50个字!', Model::EXISTS_VALIDATE, 'length'), //菜品名长度
        array('price', array(0.01, 9999.99), '价格区间为0.01-9999.99!', Model::EXISTS_VALIDATE, 'between'), //价格
        array('mprice', array(0.01, 9999.99), '价格区间为0.01-9999.99!', Model::EXISTS_VALIDATE, 'between'), //市场价格
    );
    //命名范围 可以一次定义多次调用，并且在项目中也能起到分工配合的规范，避免开发人员在写CURD操作的时候出现问题
    //项目经理只需要合理的规划命名范围即可
    protected $_scope = array(
        // 命名范围normal
        'normal' => array(
            'where' => array('status' => 1),
        ),
        // 命名范围latest
        'latest' => array(
            'order' => 'create_time DESC',
            'limit' => 10,
        ),
    );

    //表单合法性检测
    //字段比较多，可使用field方法的排除功能，例如：$User->field('status,create_time',true)->create();
}