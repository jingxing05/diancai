<?php

class CartModel extends Model {
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

    function getDishes($tbl_id) {
        $map['uniquetbl'] = $tbl_id;
        return $this->where($map)->order('mtime DESC')->field(true)->select();
    }

    function addCartdish() {
        $ret = false;
        if ($this->create()) {
            $ret = $this->add();
        }
        return $ret;
    }

    /**
     * #########################################
     * #配置区
     * #########################################
     */
    protected $tableName = 'order_cart';
    //数据库字段
    protected $fields = array(
        'ctid', 'mtime', 'uid', 'recuid', 'did',
        'amount', 'price', 'uniquetbl', 'name', 'sku', 'pic', 'special',
        '_pk' => 'ctid', '_autoinc' => true
    );
    //字段映射
    protected $_map = array(
        'pkid' => 'ctid',
        'caipin' => 'did',
        'shuliang' => 'amount', //
        'dangshijiage' => 'price', //
        'zhuohao' => 'uniquetbl', //
        'caiming' => 'name', //菜名
        'shuxing' => 'sku', //
        'teshuyaoqiu' => 'special', //
    );
    //自动完成
    protected $_auto = array(
        array('mtime', 'time', Model::MODEL_BOTH, 'function'), // add或更新时记录时间戳
    );
    //数据自动验证
    protected $_validate = array(
        array('special', '0, 50', '要求好多啊1-50个字!', Model::EXISTS_VALIDATE, 'length'), //
        array('amount', array(1, 12), '数量1-12!', Model::EXISTS_VALIDATE, 'between'), //
    );
    //命名范围 可以一次定义多次调用，并且在项目中也能起到分工配合的规范，避免开发人员在写CURD操作的时候出现问题
    //项目经理只需要合理的规划命名范围即可
    protected $_scope = array(
    );

    //表单合法性检测
    //字段比较多，可使用field方法的排除功能，例如：$User->field('status,create_time',true)->create();
}