<?php
include("../app/sk_config.php");
include("../app/sk_database.php");
$a = sk_Mysql("SELECT id_user,nama,id FROM tbl_parameter
			   WHERE id_user='".$_SESSION['UserSession']['id']."'
			   AND id ='".GetData('q')."'");
$cek = mysql_fetch_array($a);
if(empty($cek['id'])){
	echo "Data Parameter Belum diinputkan oleh admin";
}else{
echo "<table>";
while ($data=mysql_fetch_array($a)){
	echo "<tr>";
	echo "<td>";
	echo $data['nama'];
	echo "</td>";
	echo "<td>";
	echo "<input type='text' name='parameter[]' /> mg/Nm<sup>3</sup>";
	echo "</td>";
}
echo "</tr>";
echo "</table>";
}
?>