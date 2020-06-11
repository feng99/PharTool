<?php
$exts = ['php']; // 需要打包的文件后缀
$dir = __DIR__;  // 需要打包的目录

$file = 'ztjy_composer.phar'; // 包的名称, 注意它不仅仅是一个文件名, 在stub中也会作为入口前缀
$phar = new Phar("/data/web/phar/{$file}", FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, $file);

// 开始打包
$phar->startBuffering();

// 将后缀名相关的文件打包
foreach ($exts as $ext) {
    $phar->buildFromDirectory($dir, '/\.' . $ext . '$/');
}
//压缩文件 体积更小  65M->18M->4.5M
$phar->compressFiles(Phar::GZ);

// 摘除文件
$phar->delete('build.php');

// 设置入口
$phar->setStub("<?php
Phar::mapPhar('{$file}');
require 'phar://{$file}/code/bootstrap/bootstrap.php';
__HALT_COMPILER();
?>");
$phar->stopBuffering();

// 打包完成
echo "打包完成:{$file}\n";

// todo 可以执行打包文件分发脚本

/*
new Phar的参数是压缩包的名称。buildFromDirectory指定压缩的目录，第二个参数可通过正则来制定压缩文件的扩展名。

Phar::GZ表示使用gzip来压缩此文件。也支持bz2压缩。参数修改为 PHAR::BZ2即可。

setSub用来设置启动加载的文件。默认会自动加载并执行 lib_config.php。

执行此代码后，即生成一个swoole.phar文件。
*/
