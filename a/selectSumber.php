<?php  
include("../app/sk_config.php");
include("../app/sk_database.php");
$datas = sk_Mysql("SELECT id,kodeCerobong,nama FROM tbl_sumberemisi WHERE id_user='".PostData('q')."'");
$perusahaan = sk_select("tbl_user","id_user,namaPerusahaan","WHERE id_user = '".PostData('q')."'");
$_SESSION['userid'] =  array("id" =>$perusahaan[0]['id_user'],
		"nama" =>$perusahaan[0]['namaPerusahaan']);
$cekData = mysql_num_rows($datas);
echo '<option value="" selected="selected" >-Pilih Dahulu Sumber Emisi </option>';
while ($data= mysql_fetch_array($datas)) {?>
		<option value="<?php echo $data['id']; ?>"><?php echo $data['nama']."&nbsp;".$data['kodeCerobong']; ?></option>
<?php } ?>

