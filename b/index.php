<?php 
require_once ('header.php'); 
$dataPerusahaan = mysql_fetch_row(mysql_query("SELECT COUNT(*) as jumlah FROM tbl_user WHERE role='1'"));
?>
<div id="judul1">
    Selamat Datang, <?php echo $_SESSION['UserSession']['username']; ?>
</div>

<?php require_once ('footer.php'); ?>