<?php
header("content-type:text/html;charset=utf-8");
ini_set("date.timezone", "Asia/Shanghai");
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'lib/image.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'core/login_regist.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/admin.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/mysqli.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'configs/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/common.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/page.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/search.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/author.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/press.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/user.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/student.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/book.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'lib/history.func.php';
require_once $_SERVER['DOCUMENT_ROOT'].'core/statistics.php';
require_once $_SERVER['DOCUMENT_ROOT'].'core/log.php';

$_SESSION['link'] = connect();






