<?php
include("../app/sk_config.php");
include("../app/sk_database.php");
$a = sk_Mysql("SELECT idParameter,id_user,nama,id FROM tbl_parameter
			   WHERE id_user='".$_SESSION['UserSession']['id']."'
			   AND id ='".GetData('q')."'");

$cek = mysql_num_rows($a);
if($cek == 0){
	echo "Data Parameter Belum diinputkan oleh admin";
}else{
echo "<table>";
while ($data=mysql_fetch_array($a)){
	echo "<tr>";
	echo "<td>";
	echo $data['nama'];
	echo "<input type='hidden' name='param[]' value='{$data['idParameter']}' />";
	echo "</td>";
	echo "<td>";
	echo "<input type='text' name='parameter[]' /> mg/Nm<sup>3</sup>";
	echo "</td>";
}
echo "</tr>";
echo "</table>";
}
?>