<?php

return array(
//系统配置
    /* 项目设定 */
    'APP_AUTOLOAD_PATH' => '@.TagLib', // 自动加载机制的自动搜索路径,注意搜索顺序
    'APP_GROUP_LIST' => 'qt,ht', // 项目分组设定,多个组之间用逗号分隔,例如'Home,Admin'
    'APP_GROUP_MODE' => 1, // 分组模式 0 普通分组 1 独立分组
    'APP_GROUP_PATH' => 'Modules', // 分组目录 独立分组模式下面有效

    /* Cookie设置 */


    /* 默认设定 */
    'DEFAULT_THEME' => 'default', // 默认模板主题名称
    'DEFAULT_GROUP' => 'qt', // 默认分组

    /* 数据库设置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => '192.168.1.111', // 服务器地址
    'DB_NAME' => 'chuanliugoods', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '123456', // 密码
    'DB_PORT' => '3306', // 端口
    'DB_PREFIX' => 'hd_', // 数据库表前缀

    /* 数据缓存设置 */


    /* 错误设置 */
    'APP_STATUS' => 'debug', //应用调试模式状态

    /* 日志设置 */


    /* SESSION设置 */


    /* 模板引擎设置 */


    /* URL设置 */
    'URL_CASE_INSENSITIVE' => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL' => 1, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
    'URL_PATHINFO_DEPR' => '/', // PATHINFO模式下，各参数之间的分割符号


    /* 系统变量名称设置 */

    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST' => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
    'LANG_SWITCH_ON' => true, // 开启语言包功能

    //项目配置
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => '/static', // 更改默认的/Public 替换规则
        '__JS__' => '/static/js', //  JS类库路径替换规则
        '__CSS__' => '/static/css', //  css库路径替换规则
        '__IMAGES__' => '/static/images', // images库路径替换规则
        '__UPLOAD__' => '/uploads', //  上传路径替换规则
    )
);