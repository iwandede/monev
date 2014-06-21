<?php 
include_once('app/sk_config.php'); 
include_once(APP_PATH.'sk_database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo PATHURL; ?>css/style.css" type="text/css" />
	<link href="<?php echo PATHURL; ?>css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <link href="<?php echo PATHURL; ?>css/themes/custom/all.css" rel="stylesheet">
    
	<script src="<?php echo PATHURL; ?>js/jquery-1.10.2.js"></script>
	<script src="<?php echo PATHURL; ?>js/jquery-ui-1.10.4.custom.js"></script>
    <!--script src="<?php echo PATHURL; ?>js/core.js"></script>
    <script src="<?php echo PATHURL; ?>js/widget.js"></script>
    <script src="<?php echo PATHURL; ?>js/position.js"></script>
    <script src="<?php echo PATHURL; ?>js/menuselect.js"></script>
    <script src="<?php echo PATHURL; ?>js/selectmenu.js"></script-->
    <script type="text/javascript">
    $(document).ready(function(){
        $("input:submit").button();
        $("#speed").selectmenu();
    });
	</script>
<title><?php echo TITLE; ?></title>
</head>
<body>
<div id="container">
    <div id="atasan" style="border-bottom: 1px solid #D0D0D0;">
        <img height="100" src="<?php echo PATHURL; ?>images/title5.png" />
    </div>
<div id="body">
