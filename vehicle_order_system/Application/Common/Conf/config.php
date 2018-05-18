<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:48
 */

return  array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'db_vehicle_order_system',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  't_',    // 数据库表前缀
    /* 数据库设置 */
//    'DB_TYPE'               =>  'mysql',     // 数据库类型
//    'DB_HOST'               =>  '101.200.125.126', // 服务器地址
//    'DB_NAME'               =>  'student',          // 数据库名
//    'DB_USER'               =>  'student',      // 用户名
//    'DB_PWD'                =>  '123456',          // 密码
//    'DB_PORT'               =>  '3306',        // 端口
//    'DB_PREFIX'             =>  't_',    // 数据库表前缀
    'WECHAT_SDK' => array(
        'appid' => 'wx876ac0d666758d1d',
        'secret' => '12667985b36d32c6f093b232917cba2b'
    ),
);