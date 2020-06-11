<?php
// 项目入口路径
define('ZTJY_COMPOSER_PATH', __DIR__);

// 包文件路径
define('ZTJY_PACK_PATH', ZTJY_COMPOSER_PATH . '/..');

class ZtjyBootstrap
{
    /**
     * 入口
     */
    public static function run()
    {
        /**
         * 使用phalcon自动加载组件
         *
         * @return void
         */
        $loader = new \Phalcon\Loader();

        // 注册命名空间
        $loader->registerNamespaces(array(
            'App' =>  ZTJY_PACK_PATH . '/App',
        ), true);

        $loader->register();

        self::LoadFile();
    }

    /**
     * 加载其他文件
     */
    public static function LoadFile()
    {
        // 加载aliyun mns
        require ZTJY_COMPOSER_PATH . '/../App/Sdks/Library/Mns/mns-autoloader.php';
    }
}

// 执行入口
ZtjyBootstrap::run();


