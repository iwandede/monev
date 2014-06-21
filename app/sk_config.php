<?php
date_default_timezone_set( "Asia/Jakarta" );
/******************** PHP5.2.x Required **********************/
  if (version_compare(PHP_VERSION, '5.2.0', '<'))
	$error = 503;
/************************************************************/
  
/**********************SETING WEB PATH URL******************************/
define('PATHURL', 'http://'.$_SERVER['HTTP_HOST'].'/skripsi/');
define("DOCUMENT_PATH",$_SERVER['DOCUMENT_ROOT'].'/skripsi/');
/************************WAJIB DIUBAH***********************************/

/**********************Tidak Wajib Diubah*******************************/
define('APP_PATH', 'app/');
define('LIB', 'lib/');
/***********************************************************************/

/**********************SETING DATABASE**********************************/
define('DB_HOST', 'localhost');
define('DB_ROOT', 'root');
define('DB_PASS', 'rahasia');
define('DBTABLE', 'db_skripsi');
/**********************Wajib********************************************/

/*************************SETING JUDUL WEB******************************/
define("TITLE", "BPLHD | Sistem Informasi PPU");
/***************************WAJIB***************************************/
define("TAGNOTEXECUTE", "!##");

session_start();
ob_start();
mysql_connect(DB_HOST, DB_ROOT, DB_PASS) or die(mysql_error());
mysql_select_db(DBTABLE) or die(mysql_error());
require_once(DOCUMENT_PATH.APP_PATH."sk_functions.php");
?>
