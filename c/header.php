<?php 
include_once('../app/sk_config.php'); 
include_once(DOCUMENT_PATH.APP_PATH.'sk_database.php');
$current = explode("/", $_SERVER['REQUEST_URI']);
if((!$_SESSION['UserSession']))
	redirect(PATHURL);
if($_SESSION['UserSession']['role']!=3)
	redirect(PATHURL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
<head>
<meta charset="utf-8" />    
	<?php include("script.php"); ?>
<title><?php echo TITLE; ?></title>
</head>
<body>
<div id="container">
    <div id="atasan">
        <img height="100" src="<?php echo PATHURL; ?>images/title5.png" />
    </div>
    
    <!-- Menu -->
    <div id="menu">
    		
    <ul class="menu">
    	<li class="dummy"></li>
        <li class="<?php echo class_current("index", $current); ?>">
        		<a href="<?php echo PATHURL; ?>c/" class="parent"><span>Beranda</span></a>
        </li>
        <li class="<?php echo class_current("DaftarUser", $current); ?>">
        	<a href="<?php echo PATHURL.'c/evaluasi.php'?>"><span>Evaluasi</span></a>
        </li>
        <li class="last"><a href="logout.php"><span>Logout</span></a></li>
    </ul>
</div>
    <!-- End Menu-->
<div id="body">
