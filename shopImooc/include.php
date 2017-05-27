<?php
header("Content-Type:text/html;charset=utf-8");
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/lib/common.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/lib/mysql.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/lib/page.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/lib/string.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/lib/unload.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/lib/image.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/configs/configs.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/core/admin.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/core/cate.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/core/pro.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/core/album.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/core/user.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/core/proImg.inc.php';
connect();